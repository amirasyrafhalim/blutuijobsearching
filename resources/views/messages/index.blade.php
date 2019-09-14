@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Messages</h1>
        <ul>
            @foreach($chattedUsers as $user)
                <li><a href="/messages/{{ $user->id }}">{{ $user->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
