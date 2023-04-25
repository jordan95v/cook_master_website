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
        return view("equiped.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'room_id' => 'required',
            'equipment_id' => 'required',
        ]);


        Equiped::create($formFields);

        return redirect("/")->with("success", "Vous avez votre équipement dans votre salle !");
    }

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
