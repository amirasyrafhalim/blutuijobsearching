@extends('layouts.app')

@section ('content')






    <div class="container">
        <h1>User Rating</h1>
        <div class="media border p-3">
            <!--<img src="https://via.placeholder.com/150" alt="" class="img-thumbnail">-->
            <div class="col-md-6">
                <!--<h4 class="list-group-item-heading"> </h4>-->
                <p class="list-group-item-text">{{ $job->title }}</p>

                <form method="POST" action="/jobs/{{ $job->slug }}/ratings">
                @csrf {{ method_field("PATCH") }}
                    <label for="rating" class="col-md-4 col-form-label text-md-right">Pick your rate</label>

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

                    <!-- description field -->
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Leave your comment here...</label>

                        <div class="col-md-6">
                            @if(Auth::user()->id == $freelancer->id)
                                <textarea id="comment" name="comment" type="text" class="form-control">{{$job->freelancer_comment}}</textarea>
                            @elseif(Auth::user()->id == $agency->id)
                                <textarea id="comment" name="comment" type="text" class="form-control">{{$job->agency_comment}}</textarea>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Rate
                    </button>
                </form>
            </div>
        </div>
@endsection
