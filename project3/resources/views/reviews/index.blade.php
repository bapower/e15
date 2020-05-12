@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Reviews for ' . $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div>
        <div class="banner-container text-center">
            <img src="{{ $restaurant->image }}" class="img-fluid" alt="{{ $restaurant->name }}">
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
                            <a href="/restaurants/{{ $restaurant->slug }}/reviews/create" class="btn btn-outline-danger">WRITE A REVIEW</a>
                            <span>{{ count($restaurant->reviews) }} reviews</span>
                        </div>
                        @if (auth()->check())
                            @if (auth()->user()->restaurants()->find($restaurant->id))
                                <div class="reserve-btn">
                                    <div class="featured-btn-wrap">
                                        <a href="/favorites/{{ $restaurant->slug }}/destroy" class="btn btn-danger"><span class="fa fa-trash"></span> REMOVE FROM FAVORITES</a>
                                    </div>
                                </div>
                            @else
                                <div class="reserve-btn">
                                    <div class="featured-btn-wrap">
                                        <a href="/favorites/{{ $restaurant->slug }}/add" class="btn btn-danger"><span class="fa fa-heart-o"></span> ADD TO FAVORITES</a>
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
                                                    <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/edit"><i class="fa fa-edit"></i> Edit</a>
                                                </p>
                                                <p>
                                                    <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/delete"><i class="fa fa-trash"></i> Delete</a>
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
                                            @if($review->rating > 8)
                                                <div class="customer-rating good">{{ $review->rating }}</div>
                                            @elseif($review->rating > 6 && $review->rating < 9)
                                                <div class="customer-rating ok">{{ $review->rating }}</div>
                                            @elseif($review->rating > 3 && $review->rating < 7)
                                                <div class="customer-rating not-good">{{ $review->rating }}</div>
                                            @else
                                                <div class="customer-rating bad">{{ $review->rating }}</div>
                                            @endif
                                        </div>
                                        <p class="customer-text">{{ substr($review->body, 0, 100) }}...
                                            <a class="review-link" href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/">read more</a>
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
                            <a href="/restaurants/{{ $restaurant->slug }}/reviews/create">Write a review</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
