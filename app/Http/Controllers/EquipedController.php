<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'equipment_id' => 'required',
        ]);

        if (Session::has('room_id')) {
            $formFields["room_id"] = Session::get('room.id');
            Equiped::create($formFields);
            Session::remove('room_id');
            return redirect("/")->with("success", "You have connect an equipment to this room");
        }
        return back()->with('error', "Error with the room creation");
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

        if (Session::has('room')) {
            $room_id = Session::get('room');
            // Boucle pour ajouter chaque équipement sélectionné à la table equiped
            foreach ($selectedEquipment as $equipmentId) {
                Equiped::create([
                    'room_id' => $room_id,
                    'equipment_id' => $equipmentId
                ]);
            }

            // Redirection vers la page de la room avec un message de succès
            return redirect('/')->with('success', 'The selection of equipment has been successfully registered');
        }
        return back()->with('error', "Error with the room creation");
    }
}
