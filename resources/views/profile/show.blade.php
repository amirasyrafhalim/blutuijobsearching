@extends('layouts.app')

@section ('content')
    <div class="container" method="GET" {{$table}}>
        @foreach($profile as $profile)
            <h1>Freelancer Profile</h1>
            <div class="media border p-3">
                <img src="" alt="Muneerah" class="img-thumbnail" width="100" height="100">
                <div class="media-body">

                        <h4> {{$profile -> name}}</h4>
                        <ul>
                            <li>
                                From {{$profile -> location}}
                            </li>
                            <li>
                                Member since {{$profile -> emailed_verified_at}}
                            </li>
                            <li>
                                Phone Number {{$profile -> phoneNum}}
                            </li>
                        </ul>


                    <div class="col text-right"></div>
                    <a href="edit" class="btn btn-info" role="button">Edit Profile</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-8">
                    <h4>Description</h4>
                    <p> {{$profile -> description}}</p>
                    <div class="col">
                        <img src="" class="img-thumbnail" width="100" height="100">
                        <h5>Service 1</h5>
                        <p>sgfdhsbnjsxfbjh</p>
                    </div>
                    <div class="col">
                        <img src="" class="img-thumbnail" width="100" height="100">
                        <h5>Service 2</h5>
                        <p>sgfdhsbnjsxfb</p>
                    </div>
                    <div class="col">
                        <img src="" class="img-thumbnail" width="100" height="100">
                        <h5>Service 3</h5>
                        <p>sgfdhsbnjsxfbj</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h4>Prices</h4>
                    <p>Service 1 : $0000</p>
                    <p>Service 2 : $0000</p>
                    <p>Service 3 : $0000</p>
                    <br>
                    <h4>Star Rating</h4>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <a href="{{route('home')}}" class="btn btn-info" role="button">Back</a>
            <a href="{{route('jobs')}}" class="btn btn-info" role="button">Send Enquiry</a>
            <a href="{{route('jobs')}}" class="btn btn-info" role="button">Next</a>
        @endforeach
    </div>

@endsection