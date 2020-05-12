@extends('layouts.master')
@section('title')
    {{ 'Your favorite Restaurants' }}
@endsection
@section('content')
    <div class="container">
        @if($restaurants->count() == 0)
            <div class="row detail-filter-wrap">
                <div class="featured-responsive">
                    <div class="detail-filter-text">
                        <p>You have not added any restaurants to your favorites yet.</p>
                        <p><a href='http://localhost/e15/project3/public/restaurants'>Find and review restaurants</a></p>
                    </div>
                </div>
            </div>
        @else
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 responsive-wrap">
                            <div class="row light-bg detail-options-wrap mt-5">
                                @foreach ($restaurants as $i => $restaurant)
                                    <div class="col-sm-6 col-lg-12 col-xl-4 featured-responsive">
                                        <div class="featured-place-wrap">
                                            <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}">
                                                <img src="http://localhost/e15/project3/public{{ $restaurant->image }}" class="img-fluid" alt="{{ $restaurant->name }}">
                                                <span class="featured-rating-orange ">{{ $restaurant->rating }}</span>
                                                <div class="featured-title-box">
                                                    <h6>{{ $restaurant->name }}</h6>
                                                    <p>{{ count($restaurant->reviews) }} Reviews</p> <span> • </span>
                                                    <p><span>{{ str_repeat('$', $restaurant->cost_rating) }}</span>{{ str_repeat('$', 5-$restaurant->cost_rating) }}</p>
                                                    <ul>
                                                        <li><span class="icon-location-pin"></span>
                                                            <p>{{ $restaurant->street_address }}, {{ $restaurant->city }}, {{ $restaurant->state }}  {{ $restaurant->post_code }}</p>
                                                        </li>
                                                        <li><span class="icon-screen-smartphone"></span>
                                                            <p>{{ $restaurant->phone_number }}</p>
                                                        </li>
                                                        <li><span class="icon-link"></span>
                                                            <p>{{ $restaurant->url }}</p>
                                                        </li>

                                                    </ul>
                                                    <div class="card-footer">
                                                        <p>Added to your favorites {{ $restaurant->pivot->created_at->diffForHumans() }}</p>
                                                        <p><a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/destroy" dusk="remove-favorite-page"><i class="fa fa-trash"></i> Remove from Favorites</a></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
