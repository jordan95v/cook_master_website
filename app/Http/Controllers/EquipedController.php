<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Equipment $equipment)
    // {
    //     $equipment = Equiped::where("user_id", "=", Auth::id())->where("product_id", "=", $$equipment->id)->first();
    //     if ($equipment) {
    //         $equipment->quantity += 1;
    //         $equipment->update();
    //     } else {
    //         Order::create([
    //             "user_id" => Auth::id(),
    //             "product_id" => $product->id,
    //             "quantity" => 1,
    //         ]);
    //     }
    //     return back()->with("success", "Article ajouté au panier");
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
