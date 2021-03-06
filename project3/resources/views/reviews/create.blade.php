@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Write a review for ' . $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <section class="light-bg restaurant-details-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 responsive-wrap">
                    <div class="restaurant-checkbox-wrap mt-4">
                        <h5 class="mb-3">Write a review for {{ $restaurant->name }}</h5>
                        @if (auth()->check())
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method="POST" action="/restaurants/{{ $restaurant->slug }}/reviews">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" name="title" id="title" class="form-control" value='{{ old('title') }}'></input>
                                            @include('includes.error-field', ['fieldName' => 'title'])
                                        </div>
                                        <div class="form-group">
                                            <label for="body">Body:</label>
                                            <textarea name="body" id="body" cols="30" rows="8" class="form-control" >{{ old('body') }}</textarea>
                                            @include('includes.error-field', ['fieldName' => 'body'])
                                        </div>
                                        <div class="form-group">
                                            <label for='rating'>
                                                Rating:
                                            </label>
                                            <select name="rating" id="rating" class="form-control">
                                                <option value="1" {{ (old('rating') == '1') ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ (old('rating') == '2') ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ (old('rating') == '3') ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ (old('rating') == '4') ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ (old('rating') == '5') ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ (old('rating') == '6') ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ (old('rating') == '7') ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ (old('rating') == '8') ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ (old('rating') == '9') ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ (old('rating') == '10') ? 'selected' : '' }}>10</option>
                                            </select>
                                            @include('includes.error-field', ['fieldName' => 'rating'])
                                        </div>
                                        <div class="featured-btn-wrap">
                                            <button type="submit" class="btn btn-danger" dusk="publish-review">Publish</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to write a review</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
