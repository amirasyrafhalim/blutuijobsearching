@extends('layouts.app')

@section ('content')
    <div class="container">
        <h1>Freelancer Profile</h1>
        <div class="media border p-3">
            <img src="https://via.placeholder.com/150" alt="{{ $user->name }}" class="img-thumbnail">
            <div class="media-body">
                <h4>{{ $user->name }}</h4>
                <ul>
                    <li>
                        From {{ $user->country }}
                    </li>
                    <li>
                        Phone Number {{ $user->phoneNum }}
                    </li>
                </ul>
                <div class="col text-right">
                    <a href="/profile/edit" class="btn btn-info" role="button">Edit Profile</a>
                </div>
                <br>
                <div class="col text-right">
                    <a href="/profile/document" class="btn btn-info" role="button">Document</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                @if(!is_null($user->description))
                    <h4>Description</h4>
                    <p>{{ $user->description }}</p>
                @endif
                @if(!is_null($user->language))
                    <h4>Language</h4>
                    <p>{{ $user->language }}</p>
                @endif
                @if(!is_null($user->skills))
                    <h4>Skills</h4>
                    <p>{{ $user->skills }}</p>
                @endif
                @if(!is_null($user->education))
                    <h4>Education</h4>
                    <p>{{ $user->education }}</p>
                @endif
                @if(!is_null($user->cert))
                    <h4>Certificate</h4>
                    <p>{{ $user->cert }}</p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Ratings for the applied jobs</h4>
                @forelse($appliedJobs as $job)
                    @if($job->agency_rating != null && $job->status == \App\Job::STATUS_COMPLETED)
                        <h6>{{ $job->title }} - {{ $job->agency_rating }}/5</h6>
                        <p>Comment: {{ $job->agency_comment }}</p>
                        <hr>
                    @endif
                @empty
                    <p>No jobs</p>
                @endforelse
            </div>

            <div class="col-md-6">
                <h4>Ratings for the advertised jobs</h4>
                @forelse($advertisedJobs as $job)
                    @if($job->freelancer_rating != null && $job->status == \App\Job::STATUS_COMPLETED)
                        <h6>{{ $job->title }} - {{ $job->freelancer_rating }}/5</h6>
                        <p>Comment: {{ $job->freelancer_comment }}</p>
                        <hr>
                    @endif
                @empty
                    <p>No jobs</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
