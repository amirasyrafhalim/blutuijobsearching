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
    </div>
@endsection
