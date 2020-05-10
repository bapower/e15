@extends('layouts.master')
@section('title')
    All Restaurants
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Food For Thought Reviews</div>
                        @foreach ($restaurants as $restaurant)
                            <div class="card-body">
                                <h4>
                                    <a href="restaurants/{{ $restaurant->slug }}/reviews">
                                        {{ $restaurant->name}}
                                    <a>
                                </h4>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
