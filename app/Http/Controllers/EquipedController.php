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
        return view("equiped.create", ['equipment' => Equipment::all()]);
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

    public function select(Request $request)
    {
        $selectedEquipment = $request->input('equipment');
        $roomId = 7; // Remplacez 1 par l'ID de la room concernée.

        // Boucle pour ajouter chaque équipement sélectionné à la table equiped
        foreach ($selectedEquipment as $equipmentId) {
            Equiped::create([
                'room_id' => $roomId,
                'equipment_id' => $equipmentId
            ]);
        }

        // Redirection vers la page de la room avec un message de succès
        return redirect('/')->with('success', 'La sélection d\'équipements a été enregistrée avec succès.');
    }
}
