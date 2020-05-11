@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Edit a review for ' . $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <section class="light-bg booking-details_wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 responsive-wrap">
                    <div class="booking-checkbox_wrap mt-4">
                        <h5 class="mb-3">Edit review for {{ $restaurant->name }}</h5>
                        @if (auth()->check())
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method="POST" action="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" name="title" id="title" class="form-control" value='{{ old('title', $review->title) }}'></input>
                                            @include('includes.error-field', ['fieldName' => 'title'])
                                        </div>
                                        <div class="form-group">
                                            <label for="body">Body:</label>
                                            <textarea name="body" id="body" cols="30" rows="8" class="form-control" >{{ old('body', $review->body) }}</textarea>
                                            @include('includes.error-field', ['fieldName' => 'body'])
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image:</label>
                                            <input type="file" id="image" name="image" class="form-control" accept="image/*" value='{{ old('image', $review->image) }}'></input>
                                            @include('includes.error-field', ['fieldName' => 'image'])
                                        </div>
                                        <div class="featured-btn-wrap">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to edit this review</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
