@extends('layouts.app')

@section ('content')
    <div class="container">
        <h1>User Rating</h1>
        <div class="media border p-3">
            <img src="https://via.placeholder.com/150" alt="{{ $user->name }}" class="img-thumbnail">
            <div class="col-md-6">
                <h4 class="list-group-item-heading"> List group heading </h4>
                <p class="list-group-item-text"> Qui diam libris ei, vidisse incorrupte at mel. His euismod salutandi dissentiunt eu. Habeo offendit ea mea. Nostro blandit sea ea, viris timeam molestiae an has. At nisl platonem eum.
                    Vel et nonumy gubergren, ad has tota facilis probatus. Ea legere legimus tibique cum, sale tantas vim ea, eu vivendo expetendis vim. Voluptua vituperatoribus et mel, ius no elitr deserunt mediocrem. Mea facilisi torquatos ad.
                </p>
            </div>
            <div class="col-md-3 text-center">
                <div class="stars">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
                <h2> 14240 <small> Rate! </small></h2>
                <button type="button" class="btn btn-default btn-lg btn-block"> Vote Now! </button>
            </div>
        </div>
@endsection

