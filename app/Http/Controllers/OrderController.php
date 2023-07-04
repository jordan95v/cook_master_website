<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Mail\GodfatherBonus;
use App\Mail\OrderConfirmed;
use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;
use Stripe\Exception\CardException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("shop.orders", ["orders" => OrderInvoice::all()]);
    }

    public function send_order(OrderInvoice $invoice)
    {
        $user = $invoice->user;
        $invoice->update(["status" => "sent"]);
        Mail::to($user)->queue(new OrderShipped($user, $invoice));
        return back()->with("success", "Command marked as sent");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        if ($order = Order::where("user_id", Auth::id())->where("product_id", $product->id)->first()) {
            $this->update($request, $order);
        } else {
            Order::create([
                "user_id" => Auth::id(),
                "product_id" => $product->id,
            ]);
        }
        $action = ($request->get("remove")) ? "removed from" : "added to";
        return back()->with("success", "Product $action basket.");
    }

    private function update(Request $request, Order $order)
    {
        if ($request->get("remove")) {
            if ($order->quantity > 1) {
                $order->update(["quantity" => $order->quantity - 1]);
            } else {
                $this->destroy($order);
            }
        } else {
            $order->update(["quantity" => $order->quantity + 1]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view("shop.basket");
    }

    private function makeInvoice(User $user, int $shippingPrice, PayRequest $request): Invoice
    {
        // Invoice creation
        $invoice_id = uniqid($user->id . "-invoice-");
        $items = [];
        $price = 0;
        foreach ($user->orders as $value) {
            $items[] = (new InvoiceItem())
                ->title($value->product->name)
                ->pricePerUnit($value->product->price)
                ->quantity($value->quantity);
            $price += $value->product->price * $value->quantity;
        }

        $discount_price = $price - $user->total_discount;

        if ($discount_price < 0) {
            $discount_price = 0;
            $user->update(["total_discount" => $user->total_discount - $price]);
        } else {
            $user->update(["total_discount" => 0]);
        }

        $invoice = Invoice::make()
            ->buyer($user->customer($request->all()))
            ->series($invoice_id)
            ->shipping($shippingPrice)
            ->status(__('invoices::invoice.paid'))
            ->filename("invoices/$invoice_id")
            ->logo("images/logo2.png")
            ->addItems($items)
            ->totalAmount($discount_price)
            ->discountByPercent(($user->isSubscribed()) ? 5 : 0)
            ->save("public");
        return $invoice;
    }

    public function pay(PayRequest $request)
    {
        $request->validated();
        $user = User::find(Auth::id()); // I have an error otherwise.

        // Invoice configuration
        $shippingPrice = 3;

        // Payment
        $invoice = $this->makeInvoice($user, $shippingPrice, $request);

        if ($invoice->total_amount != 0) {
            try {
                $user->charge($invoice->total_amount * 100, $request->get("payment-method-id"));
                $user->increment("total_command");
            } catch (CardException $th) {
                return back()->with("error", $th->getMessage());
            }
        }

        // First order discount
        $pourcentage = $invoice->total_amount * 0.03;
        if (!$user->first_order_discount) {
            $user->update(["first_order_discount" => $pourcentage]);
            $godfather = User::where("key", $user->godfather_key)->first();
            if ($godfather) {
                $subscriptions = $godfather->getSubscription();
                if ($subscriptions != null) {
                    if (str_starts_with($subscriptions[0]->name, "pro")) {
                        $godfather->update(["total_discount" => $godfather->total_discount + $pourcentage]);
                        Mail::to($godfather)->queue(new GodfatherBonus($user, $godfather, $pourcentage));
                    }
                }
            }
        }

        // Order deletion
        foreach ($user->orders as $order) {
            $order->delete();
        }

        // OrderInvoice creation
        $invoice = OrderInvoice::create([
            "user_id" => Auth::id(),
            "price" => $invoice->total_amount,
            "serial" => $invoice->series,
        ]);

        // Mail sending
        Mail::to($user)->queue(new OrderConfirmed($user, $invoice));

        return redirect("store")->with("success", "Payment successful. Invoice available in your profile.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        foreach (Auth::user()->orders as $value) {
            if ($value->product_id == $order->product_id) {
                $value->delete();
                return back()->with("success", "Product removed from basket.");
            }
        }
        return back()->with("error", "An error occured.");
    }
}
