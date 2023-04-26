<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;

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
        $invoice_id = uniqid("SHOP-");
        $customer = new Party(
            [
                "name" => Auth::user()->name,
                "custom_fields" => [
                    "email" => Auth::user()->email,
                ],
            ]
        );

        $invoice = Invoice::make()
            ->buyer($customer)
            ->series($invoice_id)
            ->taxRate(20)
            ->shipping(1.99)
            ->status(__('invoices::invoice.paid'))
            ->filename($invoice_id)
            ->logo("images/logo2.png");

        // Price calculation
        foreach (Auth::user()->orders as $key => $value) {
            $invoice->addItem(
                (new InvoiceItem())
                    ->title($value->product->name)
                    ->pricePerUnit($value->product->price)
                    ->quantity($value->quantity)
            );
        }
        $invoice->stream();

        // Payment and save the invoice
        Auth::user()->charge($invoice->total_amount * 100, $request->get("payment-method-id"));
        $invoice->save("public");
        return back()->with("success", "Vous avez payer :)");
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
