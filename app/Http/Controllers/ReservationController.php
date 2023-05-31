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
        //
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
        // $this->authorize("create", Reservation::class); // Vérifie que l'utilisateur a le droit de créer une réservation (voir app/Providers/AuthServiceProvider.php)
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
    public function destroy()
    {
    }
}
