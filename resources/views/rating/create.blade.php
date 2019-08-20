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
                @csrf
                    <label for="rating" class="col-md-4 col-form-label text-md-right">Pick your rate</label>

                    <select id="rating" name="rating" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                    <button type="submit" class="btn btn-primary">
                        Rate
                    </button>
                </form>
            </div>
        </div>
@endsection
