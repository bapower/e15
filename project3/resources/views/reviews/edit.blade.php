@extends('layouts.master')
@section('title')
    {{ $restaurant ? 'Edit a review for ' . $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit review {{ $review->title }}</div>
                    <div class="card-body">
                        @if (auth()->check())
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <form method="POST" action="./update">
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
                                        <button type="submit" class="btn btn-primary">Update</button
                                    </form>
                                    <a href="./">Back to review</a>
                                </div>
                            </div>
                        @else
                            <p class="text-center">Please <a href="{{ route('login') }}">sign in </a>to reply to this review</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
