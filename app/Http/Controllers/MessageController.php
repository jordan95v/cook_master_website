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
        $users = User::where('id', '!=', auth()->user()->id)
        ->where('role', '=', 3)
        ->get();

        $sortedUsers = User::where(function ($query) {
            $query->whereHas('sentMessages')->orWhereHas('receivedMessages');
        })
        ->where('id', '!=', auth()->user()->id)
        ->with(['sentMessages' => function ($query) {
            $query->latest()->take(1);
        }])
        ->with(['receivedMessages' => function ($query) {
            $query->latest()->take(1);
        }])
        ->get();

        $sortedUser = $sortedUsers->sortByDesc(function ($user) {
            if ($user->sentMessages->isNotEmpty() && $user->receivedMessages->isNotEmpty()) {
                $latestSent = $user->sentMessages->max('created_at');
                $latestReceived = $user->receivedMessages->max('created_at');
                return max($latestSent, $latestReceived);
            } elseif ($user->sentMessages->isNotEmpty()) {
                return $user->sentMessages->max('created_at');
            } elseif ($user->receivedMessages->isNotEmpty()) {
                return $user->receivedMessages->max('created_at');
            } else {
                return null;
            }
        });

        return view('messages.index', compact('sortedUsers', 'users', 'sortedUser'));
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
        $message->receiver_id = $userId;
        $message->message = $request->input('content');
        $message->save();


        return redirect()->route('messages.show', $userId);
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
        $members = User::join('messages', function ($join) {
            $join->on('users.id', '=', 'messages.sender_id')
                 ->orWhere('users.id', '=', 'messages.receiver_id');
        })
        ->where('users.id', '!=', auth()->user()->id)
        ->select('users.*')
        ->distinct()
        ->get();
        $receiver = User::find($user->id);

        return view('messages.show', compact('user', 'users', 'receiver', 'messages', 'members'));
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
