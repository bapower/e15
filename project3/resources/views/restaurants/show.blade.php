@extends('layouts.master')
@section('title')
    {{ $restaurant ? $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div>
        <div class="banner-container text-center">
            <img src="http://localhost/e15/project3/public/images/restaurants/restaurant_default.jpg" class="img-fluid" alt="#">
        </div>
    </div>
    <section class="reserve-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ $restaurant->name }}</h5>
                    <p><span>$$$</span>$$</p>
                    <p class="reserve-description">Innovative cooking, paired with fine wines in a modern setting.</p>
                </div>
                <div class="col-md-6">
                    <div class="reserve-seat-block">
                        <div class="reserve-rating">
                            <span>9.5</span>
                        </div>
                        <div class="review-btn">
                            <a href=" http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/create" class="btn btn-outline-danger">WRITE A REVIEW</a>
                            <span>{{ count($restaurant->reviews) }}  reviews</span>
                        </div>
                        @if (auth()->check())
                            @if (auth()->user()->restaurants()->find($restaurant->id))
                                <div class="reserve-btn">
                                    <div class="featured-btn-wrap">
                                        <a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/destroy" class="btn btn-danger"><span class="fa fa-trash"></span> REMOVE FROM FAVORITES</a>
                                    </div>
                                </div>
                            @else
                                <div class="reserve-btn">
                                    <div class="featured-btn-wrap">
                                        <a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/add" class="btn btn-danger"><span class="fa fa-heart-o"></span> ADD TO FAVORITES</a>
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
                            <p>Tasty Hand-Pulled Noodles is a 1950s style diner located in Madison, Wisconsin. Opened in 1946 by Mickey Weidman, and located just across the street from Camp Randall Stadium, it has become a popular game day tradition amongst
                                many Badger fans. The diner is well known for its breakfast selections, especially the Scrambler, which is a large mound of potatoes, eggs, cheese, gravy, and a patrons’ choice of other toppings.</p>
                            <p>Mickies has also been featured on “Todd’s Taste of the Town” during one of ESPN’s college football broadcasts. We are one of the best Chinese restaurants in the New York, New York area. We have been recognized for our outstanding
                                Chinese & Asian cuisine, excellent Chinese menu, and great restaurant specials. We are one of the best Chinese restaurants in the New York, New York area. We have been recognized for our outstanding Chinese & Asian cuisine,
                                excellent Chinese menu, and great restaurant specials.</p>
                            <hr>
                        </div>
                    </div>
                    @if(count($restaurant->reviews) > 0)
                        <div class="booking-checkbox_wrap mt-4">
                            <h5>{{ count($restaurant->reviews) }} Reviews</h5>
                            <p class="text-center"><a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews">Read reviews for {{ $restaurant->name }}</a></p>
                        </div>
                    @else
                        <div class="booking-checkbox_wrap mt-4 text-center">
                            <p>{{ $restaurant->name }} doesn't have any reviews yet</p>
                            <p><a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/create">Write a review</a></p>
                        </div>
                    @endif
                </div>
                <div class="col-md-4 responsive-wrap">
                    <div class="contact-info">
                        <img src="http://localhost/e15/project3/public/images/restaurants/map.jpg" class="img-fluid" alt="#">
                        <div class="address">
                            <span class="fa fa-map-marker"></span>
                            <p> {{ $restaurant->street_address }}<br> {{ $restaurant->city }}, {{ $restaurant->state }} {{ $restaurant->post_code }}</p>
                        </div>
                        <div class="address">
                            <span class="fa fa-mobile"></span>
                            <p> +44 20 7336 8898</p>
                        </div>
                        <div class="address">
                            <span class="fa fa-link"></span>
                            <p>https://burgerandlobster.com</p>
                        </div>
                        <div class="address">
                            <span class="fa fa-clock-o"></span>
                            <p>Mon - Sun 09:30 am - 05:30 pm <br>
                                <span class="open-now">OPEN NOW</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
