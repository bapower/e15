@extends('layouts.master')
@section('title')
    {{ $restaurant ? $restaurant->name : 'Restaurant not found' }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $restaurant->name }}</div>
                    <div class="card-body">
                        {{ $restaurant->street_address }}
                        {{ $restaurant->city }}
                        {{ $restaurant->state }}
                        {{ $restaurant->post_code }}
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ $restaurant->slug }}/reviews">See reviews for {{ $restaurant->name }}</a>
    </div>
@endsection
