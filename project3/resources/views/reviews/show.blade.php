@extends('layouts.master')
@section('title')
    {{ $review ? $review->name : 'Review not found' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Reviews for {{ $restaurant->name }}</h2>
                <div class="card">
                    <img class="card-img-top" src="{{ $review->image }}" alt="{{ $restaurant->name }} review">
                    <div class="card-header">
                        <a href="#">{{ $review->author->name }}</a> posted:
                        {{ $review->title }}</div>
                    <div class="card-body">
                        {{ $review->body }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($review->replies as $reply)
                    @include('reviews.reply')
                @endforeach
            </div>
        </div>
        @if (auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ $review->id }}/replies">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Have a reply?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>

                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to reply to this review</ptext-center>
        @endif
    </div>
@endsection
