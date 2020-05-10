@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Reviews for ' . $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Food For Thought Reviews</div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
