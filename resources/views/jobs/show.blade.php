@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ $job->title }} <small>${{ $job->price / 100 }}</small></h1>
                <p>By {{ $job->author->name }} <small>{!! $job->isOwner() ? "- <a href=\"/jobs/" . $job->id . "/edit/\">Edit Job</a>" : '' !!}</small>
                    @if($job->isOwner())
                        <span class="badge badge-pill badge-info">{{ \App\Job::STATUS_TYPE[$job->status] }}</span>
                    @endif
                </p>
                <div class="row">
                    <img src="https://placehold.co/600x400" alt="">
                </div>
                <div class="row">
                    <p>{{ $job->description }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <h3>Apply for this job</h3>
                @if($job->isPublished())
                    @if(Auth::guest())
                        Please <a href="/login">sign in</a> to apply for job.
                    @else
                        @if(!Auth::user()->hasAppliedJob($job))
                            <form action="/{{ $job->slugWithPrefix() }}/apply" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">Apply Job</button>
                            </form>
                        @else
                            You have applied for this job.
                        @endif
                    @endif
                @else
                    Job is not published yet.
                @endif
            </div>
        </div>
    </div>
@endsection
