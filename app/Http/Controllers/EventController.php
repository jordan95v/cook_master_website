<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Equiped;
use App\Models\Event;
use App\Models\Participed;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view("event.create", ['events' => Event::all(), 'rooms' => Room::all(), 'users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $user = User::find(Auth::id());
        $form = $request->validated();

        $form["user_id"] = ($user->isAdmin()) ? $request->user_id : Auth::id();
        if ($request->hasFile('image')) {
            $form['image'] = $request->file('image')->store('images', 'public');
        }

        Event::create($form);
        return redirect("/")->with("success", "You have created an event");
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $participants = $event->participants()->pluck('users.id')->toArray();
        $participant = $event->participants()->get();
        return view('event.show', compact('event', 'participants'), ['event' => $event, 'events' => Event::all(), 'equiped' => Equiped::all(), 'participant' => $participant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('event.edit', ['event' => $event, 'events' => Event::all(), 'rooms' => Room::all(), 'users' => User::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $user = User::find(Auth::id());
        $form = $request->validated();

        $form["user_id"] = ($user->isAdmin()) ? $request->user_id : Auth::id();
        if ($request->hasFile('image')) {
            $form['image'] = $request->file('image')->store('images', 'public');
        }

        $event->update($form);
        return back()->with("success", "You have edited an event");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect("/events")->with("success", "You have deleted an event");
    }

    public function subscribe(Event $event)
    {
        // Vérifie si l'utilisateur est déjà inscrit
        $userId = Auth::id();
        if (Participed::where('user_id', $userId)->where('event_id', $event->id)->first()) {
            return redirect()->route('events.show', $event->id)->with('warning', 'You are already subscribed to this event');
        }

        // Ajoute une entrée dans la table participed liant l'utilisateur à l'événement
        Participed::create([
            'user_id' => $userId,
            'event_id' => $event->id,
        ]);

        return redirect()->route('events.show', $event->id)->with('success', 'You have subscribed to the event');
    }

    public function unsubscribe(Event $event)
    {
        // Supprime l'entrée dans la table participed liant l'utilisateur à l'événement
        Participed::where('user_id', Auth::id())->where('event_id', $event->id)->delete();
        return redirect()->route('events.show', $event->id)->with('success', 'You have unsubscribed to the event');
    }
}
