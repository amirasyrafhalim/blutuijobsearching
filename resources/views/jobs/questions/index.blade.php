@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Questions Related to Job {{ $job->title }}</h3>

        <questions-list :job="{{ $job }}"></questions-list>
    </div>
@endsection
