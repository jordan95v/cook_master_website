<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Event;
use App\Models\Participed;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'room_id' => 'required',
            'capacity' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        // Ajoute l'ID de l'utilisateur connecté
        if (Auth::user()->role == '0') {
            $formFields['user_id'] = auth()->id();
        } else {
            $formFields['user_id'] = $request->user_id;
        }

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        Event::create($formFields);

        return redirect("/")->with("success", "You have created an event");
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //Création d'un tableau contenant les id des participants à l'événement
        $participants = $event->participants()->pluck('users.id')->toArray();
        $participant = $event->participants()->get();
        //La Méthode compact permet de créer un tableau associatif avec les clés et les valeurs passées en paramètre
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
    public function update(Request $request, Event $event)
    {

        //dd($request);
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'room_id' => 'required',
            'capacity' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        // Ajoute l'ID de l'utilisateur connecté
        if (Auth::user()->role == '0') {
            $formFields['user_id'] = auth()->id();
        } else {
            $formFields['user_id'] = $request->user_id;
        }

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $event->update($formFields);

        return redirect("/events")->with("success", "You have edited an event");
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
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You have to be connected to subscribe to an event');
        }

        // Vérifie si l'utilisateur est déjà inscrit
        $userId = Auth::id();
        $participed = Participed::where('user_id', $userId)->where('event_id', $event->id)->first();
        if ($participed) {
            return redirect()->route('events.show', $event->id)->with('warning', 'You are already subscribed to this event');
        }
        // Ajoute une entrée dans la table participed liant l'utilisateur à l'événement
        Participed::create([
            'user_id' => $userId,
            'event_id' => $event->id
        ]);

        // Redirige vers la page de l'événement avec un message de confirmation
        return redirect()->route('events.show', $event->id)->with('success', 'You have subscribed to the event');
    }

    public function unsubscribe(Event $event)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You have to be connected to unsubscribe to an event');
        }

        // Supprime l'entrée dans la table participed liant l'utilisateur à l'événement
        $userId = Auth::id();
        Participed::where('user_id', $userId)->where('event_id', $event->id)->delete();

        // Redirige vers la page de l'événement avec un message de confirmation
        return redirect()->route('events.show', $event->id)->with('success', 'You have unsubscribed to the event');
    }
}
