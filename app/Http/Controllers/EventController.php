<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Event;
use App\Models\Room;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('event.index', ['events' => Event::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("event.create", ['events' => Event::all(), 'rooms' => Room::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'room_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        Event::create($formFields);

        return redirect("/")->with("success", "Vous avez crée votre événement !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('event.show', ['event' => $event, 'events' => Event::all(), 'equiped' => Equiped::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('event.edit', ['event' => $event, 'events' => Event::all(), 'rooms' => Room::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        //dd($request);
        $formFields = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'room_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $event->update($formFields);

        return back()->with("success", "Vous avez mis à jour votre événement !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect("/")->with("success", "Vous avez supprimé votre événement !");
    }
}
