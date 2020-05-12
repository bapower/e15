@extends('layouts.master')
@section('title')
    {{ $review ? $review->name : 'Review not found' }}
@endsection
@section('content')
    <section class="light-bg booking-details_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 responsive-wrap">
                    <div class="booking-checkbox_wrap mt-4">
                        <h5>{{ $review->title }}</h5>
                        <p class="text-center">Reviewed by: {{ $review->author->name }} {{ $review->created_at->diffForHumans() }}</p>
                        <div class="customer-rating py-1">{{ $review->rating }}</div>
                        @if (!is_null(auth()->user()) && auth()->user()->id === $review->user_id)
                            <div class="text-center author-actions">
                                <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/edit" dusk="edit-review"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/delete" dusk="delete-review"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        @endif
                        <hr>
                        <p class="customer-text">{{ $review->body }}</p>
                        <ul>
                            <li><img src="images/review-img1.jpg" class="img-fluid" alt="#"></li>
                            <li><img src="images/review-img2.jpg" class="img-fluid" alt="#"></li>
                            <li><img src="images/review-img3.jpg" class="img-fluid" alt="#"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($review->replies) > 0)
        <section class="light-bg booking-details_wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 responsive-wrap">
                        <div class="booking-checkbox_wrap mt-4">
                            <p>{{ count($review->replies) }} Replies</p>
                            <hr>
                            @foreach ($review->replies as $reply)
                                @include('reviews.reply')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="light-bg booking-details_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 responsive-wrap">
                    @if (auth()->check())
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form method="POST" action="{{ $review->id }}/replies">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Have a reply?">{{ old('body') }}</textarea>
                                        @include('includes.error-field', ['fieldName' => 'body'])
                                    </div>
                                    <button type="submit" class="btn btn-primary" dusk="post-reply">Post</button>

                                </form>
                            </div>
                        </div>
                    @else
                        <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to reply to this review</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
