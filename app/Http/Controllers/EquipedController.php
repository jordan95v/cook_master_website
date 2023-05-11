<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
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

        return redirect("/")->with("success", "You have connect an equipment to this room");
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
    public function edit(Equiped $equiped)
    {
        return view('equiped.edit', ['equiped' => $equiped, 'equipment' => Equipment::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, int $id)
    // {
    //     $formFields = $request->validate([
    //         'room_id' => 'required',
    //         'equipment_id' => 'required',
    //     ]);

    //     $equiped = Equiped::findOrFail($id);
    //     $equiped->update($formFields);

    //     return redirect("/")->with("success", "You have updated the equipment connected to this room");
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equiped $equiped)
    {
        $equiped->delete();
        return redirect("/")->with("success", "You have deleted  equipments connected to this room");
    }

    public function select(Request $request)
    {
        $selectedEquipment = $request->input('equipment');
        $roomId = $request->get("room_id");

        // Boucle pour ajouter chaque équipement sélectionné à la table equiped
        foreach ($selectedEquipment as $equipmentId) {
            Equiped::create([
                'room_id' => $roomId,
                'equipment_id' => $equipmentId
            ]);
        }

        // Redirection vers la page de la room avec un message de succès
        return redirect('/')->with('success', 'The selection of equipment has been successfully registered');
    }
}
