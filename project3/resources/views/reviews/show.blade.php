@extends('layouts.master')
@section('title')
    {{ $review ? $review->name : 'Review not found' }}
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
                <div class="col-md-12 text-center">
                    <h5>Review of {{ $restaurant->name }}</h5>
                    <p><span>{{ str_repeat('$', $restaurant->cost_rating) }}</span>{{ str_repeat('$', 5-$restaurant->cost_rating) }}</p>
                    <div>
                        <p class="reserve-description">{{ $restaurant->tagline }}</p>
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
                        <h5>{{ $review->title }}</h5>
                        <p class="text-center">Reviewed by: {{ $review->author->name }} {{ $review->created_at->diffForHumans() }}</p>
                        @if($review->rating > 8)
                            <div class="customer-rating py-1 good">{{ $review->rating }}</div>
                        @elseif($review->rating > 6 && $review->rating < 9)
                            <div class="customer-rating py-1 ok">{{ $review->rating }}</div>
                        @elseif($review->rating > 3 && $review->rating < 7)
                            <div class="customer-rating py-1 not-good">{{ $review->rating }}</div>
                        @else
                            <div class="customer-rating py-1 bad">{{ $review->rating }}</div>
                        @endif
                        @if (!is_null(auth()->user()) && auth()->user()->id === $review->user_id)
                            <div class="text-center author-actions">
                                <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/edit" dusk="edit-review"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/delete" dusk="delete-review"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        @endif
                        <hr>
                        <p class="customer-text">{{ $review->body }}</p>
                    </div>
                    <a href="/restaurants/{{ $restaurant->slug }}/reviews">Go back to all reviews for {{ $restaurant->name }}</a>
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
