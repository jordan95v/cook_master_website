<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //
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
        $action = ($request->get("remove")) ? "retiré" : "ajouté";
        return back()->with("success", "Article $action au panier");
    }

    public function update(Request $request, Order $order)
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
        foreach ($user->orders as $value) {
            $items[] = (new InvoiceItem())
                ->title($value->product->name)
                ->pricePerUnit($value->product->price)
                ->quantity($value->quantity);
        }
        $invoice = Invoice::make()
            ->buyer($user->customer($request->all()))
            ->series($invoice_id)
            ->shipping($shippingPrice)
            ->status(__('invoices::invoice.paid'))
            ->filename("invoices/$invoice_id")
            ->logo("images/logo2.png")
            ->addItems($items)
            ->save("public");

        $invoice->stream(); // In order to compute the price etc ...
        return $invoice;
    }

    public function pay(PayRequest $request)
    {
        $request->validated();
        $user = User::find(Auth::id()); // I have an error otherwise.

        // Invoice configuration
        $shippingPrice = 3;
        $invoice = $this->makeInvoice($user, $shippingPrice, $request);

        // Payment
        $price = $shippingPrice + $invoice->total_amount * 100;
        try {
            $user->charge($price, $request->get("payment-method-id"));
        } catch (CardException $th) {
            return back()->with("error", "Une erreur est survenue lors du paiement. Veuillez réessayer.");
        }


        // Order deletion
        foreach ($user->orders as $value) {
            $value->delete();
        }

        // Invoice creation
        OrderInvoice::create([
            "user_id" => Auth::id(),
            "price" => $invoice->total_amount,
            "serial" => $invoice->series,
        ]);
        return redirect("store")->with("success", "Paiement effectué. Facture disponible dans votre espace personnel.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        foreach (Auth::user()->orders as $value) {
            if ($value->product_id == $order->product_id) {
                $value->delete();
            }
            return back()->with("success", "Article retiré du panier.");
        }
        return back()->with("error", "Une erreur est survenue.");
    }
}
