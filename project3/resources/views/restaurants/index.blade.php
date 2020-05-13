@extends('layouts.master')
@section('title')
    All Restaurants
@endsection
@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 responsive-wrap">
                    <div class="row detail-filter-wrap">
                        <div class="col-md-4 featured-responsive">
                            <div class="detail-filter-text">
                                @if(!is_null($searchTerms))
                                    <p>{{ count($restaurants) }} restaurants found for search: <span>{{ $searchTerms }}</span></p>
                                    <p><a href="/restaurants">Browse all restaurants</a></p>
                                @elseif(!is_null($filter))
                                    <p>{{ count($restaurants) }} <span>{{$filter}}</span> restaurants found</p>
                                    <p><a href="/restaurants">Browse all restaurants</a></p>
                                @else
                                    <p>{{ count($restaurants) }} <span>Restaurants</span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row light-bg detail-options-wrap">
                        @foreach ($restaurants as $i => $restaurant)
                            <div class="col-sm-6 col-lg-12 col-xl-4 featured-responsive">
                            <div class="restaurant-list-wrap">
                                <a href="/restaurants/{{ $restaurant->slug }}">
                                    <img src="{{ $restaurant->image }}" class="img-fluid" alt="{{ $restaurant->name }}">
                                    @if($restaurant->rating > 6)
                                        <span class="featured-rating-green">{{ $restaurant->rating }}</span>
                                    @elseif($restaurant->rating > 3 && $restaurant->rating < 7)
                                        <span class="featured-rating-orange">{{ $restaurant->rating }}</span>
                                    @else
                                        <span class="featured-rating">{{ $restaurant->rating }}</span>
                                    @endif
                                    <div class="featured-title-box">
                                        <h6>{{ $restaurant->name }}</h6>
                                        <p>{{ count($restaurant->reviews) }} Reviews</p> <span> • </span>
                                        <p><span>{{ str_repeat('$', $restaurant->cost_rating) }}</span>{{ str_repeat('$', 5-$restaurant->cost_rating) }}</p>
                                        <ul>
                                            <li><span class="fa fa-map-marker"></span>
                                                <p>{{ $restaurant->street_address }}, {{ $restaurant->city }}, {{ $restaurant->state }}  {{ $restaurant->post_code }}</p>
                                            </li>
                                            <li><span class="fa fa-mobile"></span>
                                                <p>{{ $restaurant->phone_number }}</p>
                                            </li>
                                            <li><span class="fa fa-link"></span>
                                                <p>{{ $restaurant->url }}</p>
                                            </li>
                                        </ul>
                                        <div class="bottom-icons">
                                            @if(auth()->check())
                                                @if(auth()->user()->restaurants->contains($restaurant))
                                                    <span class="fa fa-heart"></span>
                                                @else
                                                    <span class="fa fa-heart-o"></span>
                                                @endif
                                            @endif
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
@endsection
