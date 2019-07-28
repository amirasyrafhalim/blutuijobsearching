@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $job->title }} <small>${{ $job->price / 100 }}</small></h1>
        <p>By {{ $job->author->name }} <small>{!! $job->isOwner() ? "- <a href=\"/jobs/" . $job->id . "/edit/\">Edit Job</a>" : '' !!}</small></p>
        @if($job->isOwner())
            <span class="badge badge-pill badge-info">{{ \App\Job::STATUS_TYPE[$job->status] }}</span>
        @endif
        <div class="row">
            <img src="https://placehold.co/600x400" alt="">
        </div>
        <div class="row">
            <p>{{ $job->description }}</p>
        </div>
    </div>
@endsection
