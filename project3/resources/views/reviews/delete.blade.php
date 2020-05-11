@extends('layouts.master')
@section('title')
    {{ 'Confirm delete review' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Confirm delete review</h1>
                        <p>Are you sure you want to delete this review?</p>
                    </div>
                    <div class="card-body">
                        <form method='POST' action='http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}'>
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <input type='submit' value='Yes I am sure' class='btn btn-danger btn-small'>
                        </form>

                    </div>
                    <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}">No I changed my mind</a>
                </div>
            </div>
        </div>
    </div>
@endsection
