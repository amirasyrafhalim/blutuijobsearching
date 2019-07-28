@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Jobs</h1>
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-md-6">
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            {{--<strong class="d-inline-block mb-2 text-primary">World</strong>--}}
                            <h3 class="mb-0"><a href="/jobs/{{ $job->slug() }}">{{ $job->title }}</a></h3>
                            <div class="mb-1 text-muted">{{ $job->created_at->diffForHumans() }} by {{ $job->author->name }}</div>
                            <p class="card-text mb-auto">{{ $job->description }}</p>
                            <a href="#" class="stretched-link"><h3>${{ $job->price }}</h3></a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
