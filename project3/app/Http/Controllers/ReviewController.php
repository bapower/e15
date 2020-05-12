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
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $review = Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurant->id,
            'title' => request('title'),
            'body' => request('body'),
            'rating' => request('rating'),
            'image' => request('image')
        ]);

        return redirect('/restaurants/' . $restaurant->slug . '/reviews/' . $review->id)->with([
            'flash-alert' => 'Your review was published'
        ]);;
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
    public function edit(string $restaurantSlug, int $id)
    {
        $review = Review::find($id);
        $restaurant = Restaurant::where('slug', '=', $restaurantSlug)->first();
        return view('reviews.edit')->with([
            'review' => $review,
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $restaurantSlug, int $id)
    {
        $review = Review::find($id);
        $restaurant = Restaurant::where('slug', '=', $restaurantSlug)->first();

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required'
        ]);

        $review->title = $request->title;
        $review->body = $request->body;
        $review->rating = (int) $request->rating;
        $review->restaurant_id = $restaurant->id;
        $review->user_id = auth()->id();
        $review->save();

        return redirect('/restaurants/' . $restaurant->slug . '/reviews/' . $review->id)->with([
            'flash-alert' => 'Your changes were saved.'
        ]);
    }

    /**
     * Show the confirmation page before destroying specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function delete(string $restaurantSlug, int $id)
    {
        $review = Review::find($id);
        $restaurant = Restaurant::where('slug', '=', $restaurantSlug)->first();

        if(!$review) {
            return back()->with(([
                'flash-alert' => 'Review not found'
            ]));
        }

        return view('reviews.delete')->with([
            'review' => $review,
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $restaurantSlug, int $reviewId)
    {
        $review = Review::find($reviewId);
        $review->replies()->delete();

        $review->delete();

        return redirect('/restaurants/' . $restaurantSlug . '/reviews/')->with([
            'flash-alert' => 'Your review was deleted'
        ]);
    }

    /**
     * Add one more helpful vote.
     *
     */
    public function helpful(string $restaurantSlug, int $reviewId)
    {
        $review = Review::find($reviewId);
        $review->helpful++;
        $review->save();

        return redirect('/restaurants/' . $restaurantSlug . '/reviews/' . $reviewId)->with([
            'flash-alert' => 'Your helpful vote for this review was recorded'
        ]);
    }
}
