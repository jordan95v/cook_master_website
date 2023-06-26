<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('messages.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, int $userId)
{
    $message = new Message();
    $message->sender_id = auth()->id();
    $message->receiver_id = $userId; // Utilisez l'ID du destinataire passé en paramètre
    $message->message = $request->input('content');
    $message->save();

    return redirect()->route('messages.show', $userId); // Redirige vers la page de conversation avec le bon utilisateur
}


    /**
     * Display the specified resource.
     */
    public function show(User $user)
{
    $messages = Message::whereIn('sender_id', [auth()->id(), $user->id])
        ->whereIn('receiver_id', [auth()->id(), $user->id])
        ->orderBy('created_at')
        ->get();

    $users = User::where('id', '!=', auth()->user()->id)->get();
    $receiver = User::find($user->id);

    return view('messages.show', compact('user', 'users','receiver','messages'));

}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
