@extends('layouts.master')
@section('title')
    {{ 'Confirm delete review' }}
@endsection
@section('content')
    <section class="light-bg booking-details_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 responsive-wrap">
                    <div class="booking-checkbox_wrap mt-4 text-center">
                        <h5 class="mb-3">Confirm delete review</h5>
                        <p>Are you sure you want to delete this review?</p>
                        @if (auth()->check())
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method='POST' action='http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}'>
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <input type='submit' value='Yes I am sure' class='btn btn-danger btn-small'>
                                    </form>
                                    <div class="mt-3">
                                        <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}">No I changed my mind</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to delete this review</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
