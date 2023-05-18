<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Equiped;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Room::class);
        return view("room.index", ["rooms" => Room::all()]);
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
    public function store(StoreRoomRequest $request)
    {
        $this->authorize("create", Room::class);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            $form["image"] = $request->file("image")->store("images", "public");
        }
        $form["user_id"] = Auth::user()->id;
        $room = Room::create($form);
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
        $equipments = [];
        foreach (Equiped::where("room_id", $room->id)->get() as $item) {
            $equipments[] = $item->equipment;
        }
        return view("room.show", ["room" => $room, "equipments" => $equipments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $this->authorize("update", $room);
        return view("room.edit", ["room" => $room, "rooms" => Room::all(), "equiped" => Equiped::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $this->authorize("update", $room);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            $form["image"] = $request->file("image")->store("images", "public");
        }
        $room->update($form);
        return redirect("/room")->with("success", "You have edited a room");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $this->authorize("delete", $room);
        $room->delete();
        return redirect("/room")->with("success", "You have deleted a room");
    }
}
