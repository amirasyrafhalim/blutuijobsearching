@extends('layouts.app')

@section ('content')
    <div class="container">
        <h1>User Rating</h1>
        <div class="media border p-3">
            <!--<img src="https://via.placeholder.com/150" alt="{{ $user->name }}" class="img-thumbnail">-->
            <div class="col-md-6">
                <!--<h4 class="list-group-item-heading"> {{ $user->name }} </h4>
                <p class="list-group-item-text">{{ $job->title }}</p>-->

                <form method="POST" action="/rating">
                @csrf
                    <label for="rating" class="col-md-4 col-form-label text-md-right">Pick your rate</label>

                    <select id="rating" name="rating" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </form>
            </div>
            <div class="col-md-3 text-center">
                <!--<div class="stars">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
                <h2> 14240 <small> Rate! </small></h2>
                <button type="button" class="btn btn-default btn-lg btn-block"> Vote Now! </button>-->
                <div class="form-group row mb-0">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">
                            Rate
                        </button>
                    </div>

                    <div class="col text-center">
                        <a href="/rating/create" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
