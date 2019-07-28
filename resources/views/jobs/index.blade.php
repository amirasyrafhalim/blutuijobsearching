@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Jobs</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Filter results
                    </div>
                    <div class="card-body">
                        <form class="input-group mb-3" method="GET" action="/jobs">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                            </div>
                            <input type="text" name="title" class="form-control" value="{{ Request::input('title') }}">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @forelse($jobs as $job)
                        <div class="col-md-6 mb-3">
                            <div class="card" style="width: 18rem;">
                                <img src="https://placehold.co/600x400" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/jobs/{{ $job->slug() }}">{{ $job->title }}</a></h5>
                                    <h6 class="card-title">{{ $job->created_at->diffForHumans() }} by {{ $job->author->name }} - {{ $job->price ? '$' . $job->price : '' }}</h6>
                                    <p class="card-text">{{ $job->excerpt() }}</p>
                                    <a href="/jobs/{{ $job->slug() }}" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No job found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
