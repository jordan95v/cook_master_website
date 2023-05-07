<?php

namespace App\Http\Controllers;

use App\Models\Equiped;
use App\Models\Event;
use App\Models\Participed;
use App\Models\Room;
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
            'capacity' => 'required',
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
        //Création d'un tableau contenant les id des participants à l'événement
        $participants = $event->participants()->pluck('users.id')->toArray();
        //La Méthode compact permet de créer un tableau associatif avec les clés et les valeurs passées en paramètre
        return view('event.show', compact('event', 'participants'), ['event' => $event, 'events' => Event::all(), 'equiped' => Equiped::all()]);
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
            'capacity' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $event->update($formFields);

        return redirect("/events")->with("success", "Vous avez mis à jour votre événement !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect("/events")->with("success", "Vous avez supprimé votre événement !");
    }

    public function subscribe(Event $event)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour vous inscrire à un événement.');
        }
        // Vérifie si l'événement existe
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Cet événement n\'existe pas.');
        }
        // Vérifie si l'utilisateur est déjà inscrit
        $userId = Auth::id();
        $participed = Participed::where('user_id', $userId)->where('event_id', $event->id)->first();
        if ($participed) {
            return redirect()->route('events.show', $event->id)->with('warning', 'Vous êtes déjà inscrit à cet événement.');
        }
        // Ajoute une entrée dans la table participed liant l'utilisateur à l'événement
        $userId = Auth::id();
        Participed::create([
            'user_id' => $userId,
            'event_id' => $event->id
        ]);

        // Redirige vers la page de l'événement avec un message de confirmation
        return redirect()->route('events.show', $event->id)->with('success', 'Vous vous êtes inscrit à l\'événement.');
    }

    public function unsubscribe(Event $event)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour vous désinscrire d\'un événement.');
        }
        // Vérifie si l'événement existe
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Cet événement n\'existe pas.');
        }
        // Vérifie si l'utilisateur est déjà inscrit
        $userId = Auth::id();
        $participed = Participed::where('user_id', $userId)->where('event_id', $event->id)->first();
        if ($participed) {
            return redirect()->route('events.show', $event->id)->with('warning', 'Vous êtes déjà inscrit à cet événement.');
        }
        // Supprime l'entrée dans la table participed liant l'utilisateur à l'événement
        $userId = Auth::id();
        Participed::where('user_id', $userId)->where('event_id', $event->id)->delete();

        // Redirige vers la page de l'événement avec un message de confirmation
        return redirect()->route('events.show', $event->id)->with('success', 'Vous vous êtes désinscrit de l\'événement.');
    }
}
