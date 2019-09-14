@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h5>{{ $job->title }}</h5>
                <div class="card">
                    <div class="card-header">User Rating</div>
                        <div class="card-body">
                            <form method="POST" action="/jobs/{{ $job->slug }}/ratings">
                                @csrf {{ method_field("PATCH") }}

                                <div class="form-group row">
                                    <label for="rating" class="col-md-4 col-form-label text-md-right">Pick your rate</label>

                                    <div class="col-md-6">
                                        @if(Auth::user()->id == $freelancer->id)
                                            <select id="rating" name="rating" class="form-control">
                                                <option {{ $job->freelancer_rating == 1 ? "selected" : "" }} value="1">1</option>
                                                <option {{ $job->freelancer_rating == 2 ? "selected" : "" }} value="2">2</option>
                                                <option {{ $job->freelancer_rating == 3 ? "selected" : "" }} value="3">3</option>
                                                <option {{ $job->freelancer_rating == 4 ? "selected" : "" }} value="4">4</option>
                                                <option {{ $job->freelancer_rating == 5 ? "selected" : "" }} value="5">5</option>
                                            </select>
                                        @elseif(Auth::user()->id == $agency->id)
                                            <select id="rating" name="rating" class="form-control">
                                                <option {{ $job->agency_rating == 1 ? "selected" : "" }} value="1">1</option>
                                                <option {{ $job->agency_rating == 2 ? "selected" : "" }} value="2">2</option>
                                                <option {{ $job->agency_rating == 3 ? "selected" : "" }} value="3">3</option>
                                                <option {{ $job->agency_rating == 4 ? "selected" : "" }} value="4">4</option>
                                                <option {{ $job->agency_rating == 5 ? "selected" : "" }} value="5">5</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="comment" class="col-md-4 col-form-label text-md-right">Leave your comment here...</label>

                                    <div class="col-md-6">
                                        @if(Auth::user()->id == $freelancer->id)
                                            <textarea id="comment" name="comment" type="text" class="form-control">{{$job->freelancer_comment}}</textarea>
                                        @elseif(Auth::user()->id == $agency->id)
                                            <textarea id="comment" name="comment" type="text" class="form-control">{{$job->agency_comment}}</textarea>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Rate
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
