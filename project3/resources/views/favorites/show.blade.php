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
                            <div class="row detail-filter-wrap">
                                <div class="col-md-4 featured-responsive">
                                    <div class="detail-filter-text">
                                        <p>34 Results For <span>Restaurants</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row light-bg detail-options-wrap">
                                @foreach ($restaurants as $i => $restaurant)
                                    <div class="col-sm-6 col-lg-12 col-xl-4 featured-responsive">
                                        <div class="featured-place-wrap">
                                            <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}">
                                                <img src="http://localhost/e15/project3/public/images/restaurants/restaurant_default.jpg" class="img-fluid" alt="#">
                                                <span class="featured-rating-orange ">6.5</span>
                                                <div class="featured-title-box">
                                                    <h6>{{ $restaurant->name }}</h6>
                                                    <p>Restaurant </p> <span>• </span>
                                                    <p>3 Reviews</p> <span> • </span>
                                                    <p><span>$$$</span>$$</p>
                                                    <ul>
                                                        <li><span class="icon-location-pin"></span>
                                                            <p>1301 Avenue, Brooklyn, NY 11230</p>
                                                        </li>
                                                        <li><span class="icon-screen-smartphone"></span>
                                                            <p>+44 20 7336 8898</p>
                                                        </li>
                                                        <li><span class="icon-link"></span>
                                                            <p>https://burgerandlobster.com</p>
                                                        </li>

                                                    </ul>
                                                    <div class="card-footer">
                                                        <p>Added to your favorites {{ $restaurant->pivot->created_at->diffForHumans() }}</p>
                                                        <p><a href="http://localhost/e15/project3/public/favorites/{{ $restaurant->slug }}/destroy"><i class="fa fa-trash"></i> Remove from Favorites</a></p>
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
