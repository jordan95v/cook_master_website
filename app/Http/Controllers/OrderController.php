<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

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
        return view("basket");
    }

    public function pay(Request $request)
    {
        $user = User::find(Auth::id()); // I have an error otherwise.

        // Invoice configuration
        $invoice_id = uniqid($user->id . "-invoice-");
        $shipping_price = 3;
        $items = [];

        // Invoice creation
        foreach ($user->orders as $value) {
            $items[] = (new InvoiceItem())
                ->title($value->product->name)
                ->pricePerUnit($value->product->price)
                ->quantity($value->quantity);
        }
        $invoice = Invoice::make()
            ->buyer($user->customer())
            ->series($invoice_id)
            ->shipping($shipping_price)
            ->status(__('invoices::invoice.paid'))
            ->filename("invoices/$invoice_id")
            ->logo("images/logo2.png")
            ->addItems($items)
            ->save("public");
        $invoice->stream(); // In order to compute the price etc ...

        // Payment and save the invoice
        $price = $shipping_price + $invoice->total_amount * 100;
        $user->charge($price, $request->get("payment-method-id"));
        foreach ($user->orders as $value) {
            $value->delete();
        }
        OrderInvoice::create([
            "user_id" => Auth::id(),
            "price" => $invoice->total_amount,
            "serial" => $invoice_id,
        ]);
        return redirect("store")->with("success", "Paiement effectué. Facture disponible dans votre espace personnel.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with("success", "Article retiré du panier.");
    }
}
