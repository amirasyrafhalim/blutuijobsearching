@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Questions Related to Job {{ $job->title }}</h3>

        <questions-list :job="{{ $job }}"></questions-list>
        <hr>
        <a href="/{{ $job->slugWithPrefix() }}" class="btn btn-outline-primary">Complete</a>
    </div>
@endsection
