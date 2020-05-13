<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display the review for the given restaurant
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function index(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        return view('reviews.index')->with([
            'restaurant' =>$restaurant
        ]);
    }

    /**
     * Show the add a review page
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function create(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        return view('reviews.create')->with([
            'restaurant' => $restaurant
        ]);;
    }

    /**
     * save the review
     *
     * @param string $slug
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();

        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required'
        ]);
        $review = Review::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurant->id,
            'title' => request('title'),
            'body' => request('body'),
            'helpful' => 0,
            'rating' => request('rating')
        ]);

        return redirect('/restaurants/' . $restaurant->slug . '/reviews/' . $review->id)->with([
            'flash-alert' => 'Your review was published'
        ]);;
    }

    /**
     * show the review page
     *
     * @param string $restaurantSlug
     * @param Review $review
     * @return Application|Factory|View
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
     * Show the edit review page
     *
     * @param string $restaurantSlug
     * @param int $id
     * @return Application|Factory|View
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
     * Update the review
     *
     * @param Request $request
     * @param string $restaurantSlug
     * @param int $id
     * @return Application|RedirectResponse|Redirector
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
     * Show the confirm delete page
     *
     * @param string $restaurantSlug
     * @param int $id
     * @return Application|Factory|RedirectResponse|View
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
     * delete the review
     *
     * @param string $restaurantSlug
     * @param int $reviewId
     * @return Application|RedirectResponse|Redirector
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
     * @param string $restaurantSlug
     * @param int $reviewId
     * @return Application|RedirectResponse|Redirector
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
