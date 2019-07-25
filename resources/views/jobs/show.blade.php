@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $job->title }} <small>${{ $job->price / 100 }}</small></h1>
        <h3>{{ $job->author->name }}</h3>
        <img src="https://placehold.co/600x400" alt="">
        <p>{{ $job->description }}</p>
    </div>
@endsection
