<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Http\Request;
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
        return view("room.create");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }


        $room = Room::create($formFields);
        Session::put("room", $room->id);


        return redirect()->route("equiped.create")->with("success", "You have created a room")->with("room_id", $room->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('room.show', ['room' => $room, 'rooms' => Room::all(), 'equiped' => Equiped::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('room.edit', ['room' => $room, 'rooms' => Room::all(), 'equiped' => Equiped::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
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
        $room->delete();

        return redirect("/room")->with("success", "You have deleted a room");
    }
}
