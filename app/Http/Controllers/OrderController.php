<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show(Order $order)
    {
        //
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
