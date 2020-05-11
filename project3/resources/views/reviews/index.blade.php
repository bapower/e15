@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Reviews for ' . $restaurant->name : 'Restaurant not found' }}
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
                            <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/create" class="btn btn-outline-danger">WRITE A REVIEW</a>
                            <span>{{ count($restaurant->reviews) }} reviews</span>
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
                <div class="col-md-8 offset-md-2 responsive-wrap">
                    <div class="booking-checkbox_wrap mt-4">
                        <h5>{{ count($restaurant->reviews) }} Reviews</h5>
                        <hr>
                        @if(count($restaurant->reviews) > 0)
                            @foreach ($restaurant->reviews as $review)
                                <div class="customer-review_wrap">
                                    <div class="customer-img">
                                        <p>Reviewed by:</p>
                                        <p>{{ $review->author->name }}</p>
                                        @if (!is_null(auth()->user()) && auth()->user()->id === $review->user_id)
                                            <div class="bottom-icons">
                                                <p>
                                                    <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/edit"><i class="fa fa-edit"></i> Edit</a>
                                                </p>
                                                <p>
                                                    <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/delete"><i class="fa fa-trash"></i> Delete</a>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="customer-content-wrap">
                                        <div class="customer-content">
                                            <div class="customer-review">
                                                <h6>{{ $review->title }}</h6>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span class="round-icon-blank"></span>
                                                <p>Reviewed {{ $review->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="customer-rating">8.0</div>
                                        </div>
                                        <p class="customer-text">{{ substr($review->body, 0, 100) }}...
                                            <a class="review-link" href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/">read more</a>
                                        </p>
                                        <ul>
                                            <li><img src="images/review-img1.jpg" class="img-fluid" alt="#"></li>
                                            <li><img src="images/review-img2.jpg" class="img-fluid" alt="#"></li>
                                            <li><img src="images/review-img3.jpg" class="img-fluid" alt="#"></li>
                                        </ul>

                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/create">Write a review</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
