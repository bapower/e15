@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Reviews for ' . $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $restaurant->name }} Reviews</h2>
                        <a href="/restaurants">Back to all restaurants</a>
                    </div>
                    <div class="card-body">
                        @if(count($restaurant->reviews) > 0)
                            @foreach ($restaurant->reviews as $review)
                                <div>
                                    <img src="{{ $review->image }}" alt="{{ $restaurant->name }} review">
                                    <h4>
                                        <a href="reviews/{{ $review->id }}">
                                            {{ $review->title }}
                                        <a>
                                    </h4>
                                    <div class="body">{{ $review->body }}</div>
                                </div>
                            @endforeach
                        @else
                            There are no reviews for {{ $restaurant->name }} yet...
                        @endif
                    </div>
                </div>
                @if (auth()->check())
                    <a href="reviews/create">Add a review for {{ $restaurant->name }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection
