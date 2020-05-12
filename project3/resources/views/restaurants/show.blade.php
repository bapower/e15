@extends('layouts.master')
@section('title')
    {{ $restaurant ? $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div>
        <div class="banner-container text-center">
            <img src="http://localhost/e15/project3/public{{ $restaurant->image }}" class="img-fluid" alt="{{ $restaurant->name }}">
        </div>
    </div>
    <section class="reserve-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ $restaurant->name }}</h5>
                    <p><span>{{ str_repeat('$', $restaurant->cost_rating) }}</span>{{ str_repeat('$', 5-$restaurant->cost_rating) }}</p>
                    <div>
                        <p class="reserve-description">{{ $restaurant->tagline }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="reserve-seat-block">
                        <div class="reserve-rating">
                            <span>{{ $restaurant->rating }}</span>
                        </div>
                        <div class="review-btn">
                            <a href=" /restaurants/{{ $restaurant->slug }}/reviews/create" class="btn btn-outline-danger">WRITE A REVIEW</a>
                            <span>{{ count($restaurant->reviews) }}  reviews</span>
                        </div>
                        @if (auth()->check())
                            @if (auth()->user()->restaurants()->find($restaurant->id))
                                <div class="reserve-btn">
                                    <div class="featured-btn-wrap">
                                        <a href="/favorites/{{ $restaurant->slug }}/destroy" dusk="remove-favorite-restaurant" class="btn btn-danger"><span class="fa fa-trash"></span> REMOVE FROM FAVORITES</a>
                                    </div>
                                </div>
                            @else
                                <div class="reserve-btn">
                                    <div class="featured-btn-wrap">
                                        <a href="/favorites/{{ $restaurant->slug }}/add" dusk="favorites-button-restaurant" class="btn btn-danger"><span class="fa fa-heart-o"></span> ADD TO FAVORITES</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="light-bg booking-details_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 responsive-wrap">
                    <div class="booking-checkbox_wrap">
                        <div class="booking-checkbox">
                            <p>{{ $restaurant->description }}</p>
                            <hr>
                        </div>
                    </div>
                    @if(count($restaurant->reviews) > 0)
                        <div class="booking-checkbox_wrap mt-4">
                            <h5>{{ count($restaurant->reviews) }} Reviews</h5>
                            <p class="text-center"><a href="/restaurants/{{ $restaurant->slug }}/reviews">Read reviews for {{ $restaurant->name }}</a></p>
                        </div>
                    @else
                        <div class="booking-checkbox_wrap mt-4 text-center">
                            <p>{{ $restaurant->name }} doesn't have any reviews yet</p>
                            <p><a href="/restaurants/{{ $restaurant->slug }}/reviews/create" dusk="write-restaurant-review">Write a review</a></p>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 responsive-wrap">
                    <div class="contact-info">
                        <img src="/images/restaurants/map.jpg" class="img-fluid" alt="#">
                        <div class="address">
                            <span class="fa fa-map-marker"></span>
                            <p>{{ $restaurant->street_address }}<br> {{ $restaurant->city }}, {{ $restaurant->state }} {{ $restaurant->post_code }}</p>
                        </div>
                        <div class="address">
                            <span class="fa fa-mobile"></span>
                            <p>{{ $restaurant->phone_number }}</p>
                        </div>
                        <div class="address">
                            <span class="fa fa-link"></span>
                            <p>{{ $restaurant->url }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
