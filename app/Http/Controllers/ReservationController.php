<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

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
        $form["created_by"] = $user->id; // Ajoute l'id de l'utilisateur connecté
        $form["status"] = "pending";
        Reservation::create($form);
        return redirect("/")->with("success", "You have sent your request");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservation.index')->with('success', 'Reservation deleted successfully');
    }


    public function assignChef(Request $request, Reservation $reservation)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
        ]);

        // Mettez à jour le statut de la réservation avec l'ID du chef attribué dans la base de données
        $reservation->user_id = $validatedData['user_id'];
        $reservation->status = 'accepted';
        $reservation->save();

        // Redirigez ou retournez une réponse appropriée
        return redirect()->route('reservation.index')->with('success', 'Chef assigned successfully');
    }

    public function RejectReservation(Reservation $reservation)
    {
        $reservation->status = 'rejected';
        $reservation->save();

        return redirect()->route('reservation.index')->with('success', 'Reservation rejected successfully');
    }
}
