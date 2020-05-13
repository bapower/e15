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
    <section class="restaurant-detail-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5>Review of {{ $restaurant->name }}</h5>
                    <p><span>{{ str_repeat('$', $restaurant->cost_rating) }}</span>{{ str_repeat('$', 5-$restaurant->cost_rating) }}</p>
                    <div>
                        <p class="restaurant-detail-description">{{ $restaurant->tagline }}</p>
                        <br>
                        <p class="mt-3"><a href="/restaurants/{{ $restaurant->slug }}/reviews" class="text-info">See all reviews</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="light-bg restaurant-details-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 responsive-wrap">
                    <div class="restaurant-checkbox-wrap mt-4">
                        <h5>{{ $review->title }}</h5>
                        <p class="text-center">Reviewed by: {{ $review->author->name }} {{ $review->created_at->diffForHumans() }}</p>
                        @if($review->rating > 8)
                            <div class="user-rating py-1 good">{{ $review->rating }}</div>
                        @elseif($review->rating > 6 && $review->rating < 9)
                            <div class="user-rating py-1 ok">{{ $review->rating }}</div>
                        @elseif($review->rating > 3 && $review->rating < 7)
                            <div class="user-rating py-1 not-good">{{ $review->rating }}</div>
                        @else
                            <div class="user-rating py-1 bad">{{ $review->rating }}</div>
                        @endif
                        @if (!is_null(auth()->user()) && auth()->user()->id === $review->user_id)
                            <div class="text-center author-actions">
                                <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/edit" dusk="edit-review"><i class="fa fa-edit"></i> Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/delete" dusk="delete-review"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        @endif
                        <hr>
                        <p class="user-text">{{ $review->body }}</p>
                        @if(auth()->check())
                            <div class="mt-3 helpful-container text-center">
                                <span class="text-info">{{ $review->helpful }} people marked this review as helpful</span>
                                <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/helpful" dusk="helpful-button"><span class="fa fa-thumbs-up"></span>  Helpful</a>
                            </div>
                        @endif
                    </div>
                    <a href="/restaurants/{{ $restaurant->slug }}/reviews">Go back to all reviews for {{ $restaurant->name }}</a>
                </div>
            </div>
        </div>
    </section>
    @if (count($review->replies) > 0)
        <section class="light-bg restaurant-details-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 responsive-wrap">
                        <div class="restaurant-checkbox-wrap mt-4">
                            <p>{{ count($review->replies) }} Replies</p>
                            <hr>
                            @foreach ($review->replies->sortByDesc('created_at') as $reply)
                                @include('reviews.reply')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="light-bg restaurant-details-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 responsive-wrap">
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
