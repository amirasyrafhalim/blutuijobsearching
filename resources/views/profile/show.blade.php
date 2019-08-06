@extends('layouts.app')

@section ('content')

    <div class="container">
        <h1>Freelancer Profile</h1>
        <div class="media border p-3">
            <img src="" alt="Muneerah" class="img-thumbnail" width="100" height="100">
            <div class="media-body">
                <h4>Hi, I am {{ $user->name }}</h4>
                <ul>
                    <li>
                        From: {{$user->country}}
                    </li>
                    <li>
                        Phone Number: {{$user -> phoneNum}}
                    </li>
                </ul>
                <div class="col text-right">
                    <a href="/profile/edit" class="btn btn-info" role="button">Edit Profile</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                <h4>Description</h4>
                <p>{{$user -> description}}</p>
                <h4>Language</h4>
                <p>{{$user->language}}</p>
                <h4>Skills</h4>
                <p>{{$user->skills}}</p>
                <h4>Education</h4>
                <p>{{$user->education}}</p>
                <h4>Certificate</h4>
                <p>{{$user->cert}}</p>
            </div>
        </div>
    </div>
@endsection
