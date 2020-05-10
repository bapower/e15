<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        return view('reviews.index')->with([
            'restaurant' =>$restaurant
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        return view('reviews.create')->with([
            'restaurant' => $restaurant
        ]);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();

        $this->validate(request(), [
            //'restaurant_id' => 'required|exists:restaurants,id',
            'title' => 'required',
            'body' => 'required'
        ]);
        $review = Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurant->id,
            //'restaurant_id' => $restaurantId,
            'title' => request('title'),
            'body' => request('body'),
            'image' => request('image')
        ]);

        return redirect('/restaurants/' . $restaurant->slug . '/reviews/' . $review->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(string $restaurantSlug, Review $review)
    {
        $restaurant = Restaurant::where('slug', '=', $restaurantSlug)->first();
        return view('reviews.show')->with([
            'restaurant' => $restaurant,
            'review' => $review
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
