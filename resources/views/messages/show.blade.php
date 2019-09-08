@extends('layouts.app')

@section('content')
    <div class="container">
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
@endsection
