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
            @if($job->hired_user_id != null)
                <div class="card-footer">
                    <form action="/jobs/{{ $job->id }}/applicant/{{ $applicant->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary float-right">Hire Applicant</button>
                    </form>
                </div>
            @endif
        </div>

    </div>
@endsection
