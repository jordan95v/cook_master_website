<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.index', ['reservations' => Reservation::all(), 'users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateReservationRequest $request)
    {
        //revoir la partie authentification
        $user = User::find(Auth::id()); // Récupère l'utilisateur connecté
        $form = $request->validated(); // Récupère les données du formulaire validées
        $form["user_id"] = $user->id; // Ajoute l'id de l'utilisateur connecté
        Reservation::create($form);
        return redirect("/")->with("success", "You have sent your request");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservation.index')->with('success', 'Reservation deleted successfully');
    }

    public function assign_chef(Request $request, Reservation $reservation)
    {
        $form = $request->validate([
            'user_id' => 'required',
        ]);

        $reservation->update([
            'assigned_to' => $form['user_id'],
            'status' => 'accepted',
        ]);
        return redirect()->route('reservation.index')->with('success', 'Chef assigned successfully');
    }

    public function reject_reservation(Reservation $reservation)
    {
        $reservation->update(["status" => "rejected"]);
        return redirect()->route('reservation.index')->with('success', 'Reservation rejected successfully');
    }
}
