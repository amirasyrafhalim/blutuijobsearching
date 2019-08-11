@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Questions Related to Job {{ $job->title }}</h3>

        <ul>
            @foreach($job->questions as $question)
                <li>{{ $question->title }}</li>
            @endforeach
        </ul>

        <questions-list :questions="{{ $job->questions }}"></questions-list>
    </div>
@endsection
