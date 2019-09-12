@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Message with {{ $receiver->name }}</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="flex-column">
                    @foreach($messages as $message)
                        @if($message->sender_id == auth()->user()->id)
                            <div class="card mt-3">
                                <div class="card-header">
                                    You said...
                                </div>
                                <div class="card-body">
                                    <p class="text-left mb-0">{{ $message->body }}</p>
                                </div>
                            </div>
                        @else
                            <div class="card mt-3">
                                <div class="card-header">
                                    <p class="text-right mb-0">{{ $message->sender->name }} said...</p>
                                </div>

                                <div class="card-body">
                                    <div class="flex-row">
                                        <p class="text-right">{{ $message->body }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Send message
                    </div>
                    <div class="card-body">
                        <div class="flex-row">
                            <form action="/messages/{{ $receiver->id }}" method="POST">
                                @csrf
                                <textarea name="body" class="form-control" placeholder="Type your message..."></textarea>
                                <button class="btn btn-outline-primary float-right mt-2">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
