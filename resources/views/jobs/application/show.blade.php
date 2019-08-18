@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Application by {{ $applicant->name }}
            </div>
            <div class="card-body">
                @foreach($job->questions as $question)
                    <h3>{{ $question->title }}</h3>
                    <p>{{ json_decode($question->answer->answers) }}</p>
                @endforeach
            </div>
        </div>

    </div>
@endsection
