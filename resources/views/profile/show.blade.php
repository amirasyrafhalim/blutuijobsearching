@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile</h1>
        @foreach($names as $name)
            {{ $name }}
        @endforeach
    </div>
@endsection