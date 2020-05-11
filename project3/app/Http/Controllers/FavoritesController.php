<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Review;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $restaurants = auth()->user()->restaurants->sortByDesc('pivot.created_at');
        return view('favorites.show')->with([
            'restaurants' => $restaurants,
        ]);
    }

    public function add(Request $request, string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        auth()->user()->restaurants()->save($restaurant);

        return redirect('/favorites')->with([
            'flash-alert' => $restaurant->name . ' was added to your favorites.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $user = auth()->user();
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        $restaurant->users()->detach($user);

        return redirect('/favorites')->with([
            'flash-alert' => $restaurant->name . ' was removed from your favorites.'
        ]);
    }
}
