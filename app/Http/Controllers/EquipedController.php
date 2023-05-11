<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
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
        return view("equiped.create", ["equipment" => Equipment::where('is_available', true)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, )
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
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room_equipement = [];
        foreach (Equiped::where('room_id', $room->id)->get() as $item) {
            $room_equipement[] = $item->equipment;
        }
        return view('equiped.edit', [
            'room_equipement' => $room_equipement,
            'available' => Equipment::where('is_available', true)->get(),
            'room' => $room,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equiped $equiped)
    {
        $equiped->equipment->update(['is_available' => true]);
        $equiped->delete();
        return back()->with("success", "You have deleted  equipments connected to this room");
    }

    public function select(Request $request)
    {
        $selected_equipment = $request->input('equipment');

        if (Session::has('room')) {
            $room_id = Session::get('room');
            // Boucle pour ajouter chaque équipement sélectionné à la table equiped
            foreach ($selected_equipment as $equipment_id) {
                $equipement = Equipment::find($equipment_id);
                Equiped::create(['room_id' => $room_id, 'equipment_id' => $equipment_id]);
                $equipement->update(['is_available' => false]);
            }

            // Redirection vers la page de la room avec un message de succès
            return redirect()->route("room.show", ["room" => $room_id])
                ->with('success', 'The selection of equipment has been successfully registered');
        }
        return back()->with('error', "Error with the room creation");
    }
}
