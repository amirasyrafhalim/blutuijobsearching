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

    public function show(User $receiver)
    {
        $messages = Message::where(function ($query) use ($receiver) {
            $query->where([
               'sender_id' => auth()->user()->id,
               'recipient_id' => $receiver->id,
            ]);
        })->orWhere(function ($query) use ($receiver) {
            $query->where([
                'sender_id' => $receiver->id,
                'recipient_id' => auth()->user()->id,
            ]);
        })->with(['sender', 'recipient'])->get();

        return view('messages.show', compact('messages', 'receiver'));
    }

    public function store(User $receiver, Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->recipient_id = $receiver->id;
        $message->body = $request->body;
        $message->save();

        return redirect()->back();
    }
}
