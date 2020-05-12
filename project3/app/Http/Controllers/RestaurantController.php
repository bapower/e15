<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchedRestaurants = session('searchedRestaurants', null);
        $restaurants = is_null($searchedRestaurants) ? Restaurant::latest()->get() : $searchedRestaurants;
        return view('restaurants.index')->with([
            'restaurants' => $restaurants,
            'searchTerms' => session('searchTerms', null),
            'filter' => session('filter', null),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();

        return view('restaurants.show')->with([
            'restaurant' => $restaurant
        ]);
    }

    /**
     * GET
     * /search
     * Show search results
     * @param Request $request
     * @return string
     */
    public function search(Request $request)
    {
        $searchTerms = $request->input('searchTerms', null);
        $restaurants = Restaurant::where('name', 'LIKE', '%'.$searchTerms.'%')->get();

        return redirect('/restaurants')->with([
            'searchTerms' => $searchTerms,
            'searchedRestaurants' => $restaurants
        ]);
    }

    /**
     * GET
     * /popular
     * Show popular restaurants
     * @param Request $request
     * @return string
     */
    public function popular(Request $request)
    {
        $restaurants = Restaurant::where('rating', '>', '8')->get();

        return redirect('/restaurants')->with([
            'searchedRestaurants' => $restaurants,
            'filter' => 'popular'
        ]);
    }

    /**
     * GET
     * /recent
     * Show recently added restaurants
     * @param Request $request
     * @return string
     */
    public function recent(Request $request)
    {
        $restaurants = Restaurant::where('created_at', '>', Carbon::now()->subDays(90))->get();

        return redirect('/restaurants')->with([
            'searchedRestaurants' => $restaurants,
            'filter' => 'recently added'
        ]);
    }
}
