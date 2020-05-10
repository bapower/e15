@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Reviews for {{ $restaurant->name }}</h2>
                <div class="card">
                    <img class="card-img-top" src="{{ $review->image }}" alt="{{ $restaurant->name }} review">
                    <div class="card-header">{{ $review->title }}</div>
                    <div class="card-body">
                        {{ $review->body }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($review->replies as $reply)
                    <div class="card">
                        <div class="card-header">
                            <a href="#">
                                {{ $reply->author->name }} said {{ $reply->created_at->diffForHumans() }} ...
                            </a>
                        </div>
                        <div class="card-body">
                            {{ $reply->body }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
