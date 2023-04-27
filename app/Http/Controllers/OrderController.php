<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
    public function store(Product $product)
    {
        $order = Order::where("user_id", "=", Auth::id())->where("product_id", "=", $product->id)->first();
        if ($order) {
            $order->quantity += 1;
            $order->update();
        } else {
            Order::create([
                "user_id" => Auth::id(),
                "product_id" => $product->id,
                "quantity" => 1,
            ]);
        }
        return back()->with("success", "Article ajouté au panier");
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
        // Invoice configuration
        $invoice_id = uniqid(Auth::user()->id . "-invoice-");
        $shipping_price = 3;
        $items = [];

        // Invoice creation
        foreach (Auth::user()->orders as $value) {
            $items[] = (new InvoiceItem())
                ->title($value->product->name)
                ->pricePerUnit($value->product->price)
                ->quantity($value->quantity);
        }
        $invoice = Invoice::make()
            ->buyer(Auth::user()->customer)
            ->series($invoice_id)
            ->shipping($shipping_price)
            ->status(__('invoices::invoice.paid'))
            ->filename($invoice_id)
            ->logo("images/logo2.png")
            ->addItems($items)
            ->save("public/invoices");
        $invoice->stream();

        // Payment and save the invoice
        $price = $shipping_price + $invoice->total_amount * 100;
        Auth::user()->charge($price, $request->get("payment-method-id"));
        Auth::user()->orders->delete();
        return redirect("store")->with("success", "Vous avez payer :)");
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
