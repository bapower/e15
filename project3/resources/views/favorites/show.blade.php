@extends('layouts.master')
@section('title')
    {{ 'Your favorite Restaurants' }}
@endsection
@section('content')
    <div class="container">
        @if($restaurants->count() == 0)
            <div class="row justify-content-center">
                <p>You have not added any restaurants to your favorites yet.</p>
                <p><a href='/restaurants'>Find and review restaurants</a></p>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            @foreach($restaurants as $restaurant)
                                <div>
                                    <a href='/restaurants/{{ $restaurant->slug }}'><h2>{{ $restaurant->name }}</h2></a>
                                    <p class='added'>
                                        Added {{ $restaurant->pivot->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
