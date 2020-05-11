@extends('layouts.master')
@section('title')
    {{ $restaurant ? $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $restaurant->name }}</div>
                    <div class="card-body">
                        {{ $restaurant->street_address }}
                        {{ $restaurant->city }}
                        {{ $restaurant->state }}
                        {{ $restaurant->post_code }}
                    </div>
                    @if (auth()->check())
                        <div class="card-footer">
                            <ul class="list-group">
                                @if (auth()->user()->restaurants()->find($restaurant->id))
                                    <li class="list-group-item"><a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/destroy"><i class="fa fa-trash"></i> Remove from Favorites</a></li>
                                @else
                                    <li class="list-group-item"><a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/add"><i class="fa fa-plus"></i> Add to Favorites</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews">See reviews for {{ $restaurant->name }}</a>
    </div>
@endsection
