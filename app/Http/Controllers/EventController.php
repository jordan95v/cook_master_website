<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Equiped;
use App\Models\Event;
use App\Models\Participed;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function planning()
    {
        return view("event.planning", ["events" => Event::all()]);
    }

    public function admin_index()
    {
        $this->authorize("viewAny", Event::class);
        $events = (User::find(Auth::id())->isAdmin() ? Event::all() : Auth::user()->events);
        return view('event.admin-index', ['events' => $events]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::simplePaginate(9);
        if ($request->get("only_course")) {
            $events = Event::where("is_course", true)->simplePaginate(9);
        }
        return view('event.index', ['events' => $events, "only_course" => $request->get("only_course")]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Event::class);
        return view("event.create", ['rooms' => Room::all(), 'users' => User::all(), "events" => Event::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $this->authorize("create", Event::class);
        $form = $request->validated();

        // Check if the room is already booked
        $events = Event::where("date", $request->date)->where("room_id", $request->room_id)->get();
        foreach ($events as $event) {
            if ($request->start_time < $event->end_time && $request->start_time > $event->start_time) {
                return back()->with("error", "This room is already booked at this time")->withInput();
            }
            if ($request->end_time > $event->start_time && $request->end_time < $event->end_time) {
                return back()->with("error", "This room is already booked at this time")->withInput();
            }
        }

        $user = User::find(Auth::id());
        $form["user_id"] = ($user->isAdmin()) ? $request->user_id : $user->id;
        $form["created_by"] = $user->id;
        if ($request->hasFile('image')) {
            $form['image'] = $request->file('image')->store('events', 'public');
        }
        Event::create($form);
        return back()->with("success", "You have created an event");
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
        $this->authorize("update", $event);
        return view('event.edit', ['event' => $event, 'events' => Event::all(), 'rooms' => Room::all(), 'users' => User::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize("update", $event);
        $user = User::find(Auth::id());
        $form = $request->validated();
        $form["user_id"] = ($user->isAdmin()) ? $request->user_id : $user->id;
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
        $this->authorize("delete", $event);
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
