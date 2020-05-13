<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    /**
     * Display the list of restaurants.
     * @return Application|Factory|View
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
     * Display the restaurant page
     *
     * @param string $slug
     * @return Application|Factory|View
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
     * @return Application|RedirectResponse|Redirector
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
     * @return Application|RedirectResponse|Redirector
     */
    public function popular()
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
     *  @return Application|RedirectResponse|Redirector
     */
    public function recent()
    {
        $restaurants = Restaurant::where('created_at', '>', Carbon::now()->subDays(90))->get();

        return redirect('/restaurants')->with([
            'searchedRestaurants' => $restaurants,
            'filter' => 'recently added'
        ]);
    }
}
