<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Mail\HomeCourse;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.index', ['reservations' => Reservation::all(), 'users' => User::where("is_service_provider", true)->get()]);
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
        $user = User::find(Auth::id());
        $form = $request->validated();
        $form["user_id"] = $user->id;
        Reservation::create($form);
        return back()->with("success", "You have sent your request");
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

        $user = User::find($form['user_id']);
        if (!$user->is_service_provider) {
            return back()->with('error', 'This user is not a chef');
        }

        $reservation->update([
            'assigned_to' => $form['user_id'],
            'status' => 'accepted',
        ]);
        Mail::to($reservation->user)->queue(new HomeCourse($reservation->user, $reservation, 'accepted'));
        return redirect()->route('reservation.index')->with('success', 'Chef assigned successfully');
    }

    public function reject_reservation(Reservation $reservation)
    {
        $reservation->update(["status" => "rejected"]);
        Mail::to($reservation->user)->queue(new HomeCourse($reservation->user, $reservation, 'rejected'));
        return redirect()->route('reservation.index')->with('success', 'Reservation rejected successfully');
    }
}
