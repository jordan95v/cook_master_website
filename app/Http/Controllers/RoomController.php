<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Http\Request;

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


        Room::create($formFields);

        return redirect("/equiped/create")->with("success", "Vous avez créer une salle !");
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
