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
        $this->authorize("create", Equiped::class);
        return view("equiped.create", ["equipment" => Equipment::where("is_available", true)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", Equiped::class);
        $form = $request->validate([
            "equipment_id" => "required",
        ]);

        if (Session::has("room_id")) {
            $form["room_id"] = Session::get("room.id");
            Equiped::create($form);
            Session::remove("room_id");
            return redirect("/")->with("success", "You have connect an equipment to this room");
        }
        return back()->with("error", "Error with the room creation");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $this->authorize("update", $room);
        $room_equipement = [];
        foreach (Equiped::where("room_id", $room->id)->get() as $item) {
            $room_equipement[] = $item;
        }
        Session::put("room", $room->id);
        return view("equiped.edit", [
            "room_equipement" => $room_equipement,
            "available" => Equipment::where("is_available", true)->get(),
            "room" => $room,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equiped $equiped)
    {
        $this->authorize("delete", $equiped);
        $equiped->equipment->update(["is_available" => true]);
        $equiped->delete();
        return back()->with("success", "You have deleted equipments connected to this room");
    }

    public function select(Request $request)
    {
        $selected_equipment = $request->input("equipment");

        if (Session::has("room")) {
            $room_id = Session::get("room");
            $this->authorize("update", Room::find($room_id));

            foreach ($selected_equipment as $equipment_id) {
                $equipement = Equipment::find($equipment_id);
                Equiped::create(["room_id" => $room_id, "equipment_id" => $equipment_id]);
                $equipement->update(["is_available" => false]);
            }

            return redirect()->route("room.show", ["room" => $room_id])
                ->with("success", "The selection of equipment has been successfully registered.");
        }
        return back()->with("error", "Error with the room creation.");
    }
}
