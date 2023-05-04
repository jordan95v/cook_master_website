<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('equipment.index', ['equipments' => Equipment::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("equipment.create", ['equipment' => Equipment::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'brand' => 'required',
            'description' => 'required',
        ]);


        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        Equipment::create($formFields);

        return redirect("/")->with("success", "Vous avez crée votre équipement !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', ['equipment' => $equipment, 'equipments' => Equipment::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', ['equipment' => $equipment, 'equipments' => Equipment::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'brand' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $equipment->update($formFields);

        return redirect("/equipment")->with("success", "Vous avez modifié l'équipement !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect("/equipment")->with("success", "Vous avez supprimé l'équipement !");
    }
}
