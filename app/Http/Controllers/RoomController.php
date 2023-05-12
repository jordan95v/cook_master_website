<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('room.index', ['rooms' => Room::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Room::class);
        return view("room.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", Room::class);
        $formFields = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
        $formFields['user_id'] = Auth::user()->id;

        $room = Room::create($formFields);

        if (count(Equipment::where("is_available", true)->get()) > 0) {
            Session::put("room", $room->id);
            return redirect()->route("equiped.create")->with("success", "You have created a room");
        }
        return back()->with("success", "You have created a room");
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        foreach (Equiped::where('room_id', $room->id)->get() as $item) {
            $equipement[] = $item->equipment;
        }
        return view('room.show', ['room' => $room, "equipments" => $equipement]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $this->authorize("update", $room);
        return view('room.edit', ['room' => $room, 'rooms' => Room::all(), 'equiped' => Equiped::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $this->authorize("update", $room);
        $formFields = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $room->update($formFields);

        return redirect("/room")->with("success", "You have edited a room");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $this->authorize("update", $room);
        $room->delete();
        return redirect("/room")->with("success", "You have deleted a room");
    }
}
