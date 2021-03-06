@extends('layouts.master')

@section('head')
    <link href='/css/pages/welcome.css' rel='stylesheet'>
@endsection

@section('content')

    <section class="welcome-banner d-flex align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="welcome-banner-title_box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="welcome-banner-content_wrap">
                                    <h1>Find and review great restaurants</h1>
                                    <h5>Uncover places to eat that you'll love.</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10">
                                <form class="form-wrap mt-4" method='GET' action='/search'>
                                    <div class="btn-group" role="group">
                                        <input type="text" name='searchTerms' placeholder="Search for a restaurant" class="btn-group1">
                                        <button type="submit" dusk="search-button" class="btn-form"><span class="fa fa-search search-icon"></span>SEARCH<i class="pe-7s-angle-right"></i></button>
                                    </div>
                                </form>
                                <div class="welcome-banner-link">
                                    <a href="/restaurants/popular">Browse Popular</a><span>or</span> <a href="/restaurants/recent">Recently Added</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
