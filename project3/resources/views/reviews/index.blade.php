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
                        <a href="http://localhost/e15/project3/public/restaurants">Back to all restaurants</a>
                    </div>
                    <div class="card-body">
                        @if(count($restaurant->reviews) > 0)
                            @foreach ($restaurant->reviews as $review)
                                <div>
                                    <img src="{{ $review->image }}" alt="{{ $restaurant->name }} review">
                                    <h4>
                                        <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}">
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
                    @if (auth()->check())
                        <div class="card-footer">
                            <ul class="list-group">
                                @if (auth()->user()->restaurants()->find($restaurant->id))
                                    <li class="list-group-item"><a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/destroy"><i class="fa fa-trash"></i> Remove from Favorites</a></li>
                                @else
                                    <li class="list-group-item"><a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/add"><i class="fa fa-plus"></i> Add to Favorites</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                @if (auth()->check())
                    <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/create">Add a review for {{ $restaurant->name }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection
