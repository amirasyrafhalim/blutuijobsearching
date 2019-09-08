<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::where('sender_id', auth()->user()->id)->orWhere('recipient_id', auth()->user()->id)->get();

        return view('messages.index', compact('messages'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->user()->id);
            $query->orWhere('sender_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('recipient_id', auth()->user()->id);
            $query->orWhere('recipient_id', $user->id);
        })->with(['sender', 'recipient'])->get();

        return view('messages.show', compact('messages'));
    }
}
