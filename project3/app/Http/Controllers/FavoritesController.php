<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the users list of favorites.
     * @return Application|Factory|View
     */
    public function show()
    {
        $restaurants = auth()->user()->restaurants->sortByDesc('pivot.created_at');
        return view('favorites.show')->with([
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Add a favorite restaurant to the user's favorites
     * @return Application|RedirectResponse|Redirector
     */
    public function add(string $slug)
    {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        auth()->user()->restaurants()->save($restaurant);

        return redirect('/favorites')->with([
            'flash-alert' => $restaurant->name . ' was added to your favorites.'
        ]);
    }

    /**
     * Remove the relationship between restaurant and user
     *
     * @param string $slug
     * @return Application|RedirectResponse|Redirector
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
