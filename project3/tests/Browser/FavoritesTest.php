<?php

namespace Tests\Browser;

use App\Restaurant;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FavoritesTest extends DuskTestCase
{
    /**
     * test can't see favorites page when not logged in
     * @group favorites
     * @return void
     */
    public function testCantSeeFavoritesNotLoggedIn()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost/e15/project3/public/')
                ->assertSee('Login');
        });
    }

    /**
     * test user has no favorites
     * @group favorites
     * @return void
     */
    public function testNoFavoritesYet()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $browser->loginAs($user->id)
                ->visit('http://localhost/e15/project3/public/favorites')
                ->assertSee('You have not added any restaurants to your favorites yet.');
        });
    }

    /**
     * test adding a restaurant to favorites
     * @group favorites
     * @return void
     */
    public function testAddToFavorites()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $restaurant = factory(Restaurant::class)->create();
            $browser->loginAs($user->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$restaurant->slug)
                ->click('@favorites-button-restaurant')
                ->assertSee($restaurant->name);
        });
    }

    /**
     * test removing a restaurant from favorites by clicking the link on the favorites page
     * @group favorites
     * @return void
     */
    public function testRemoveFromFavoritesOnFavoritesPage()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->state('withRestaurant')->create();
            $restaurant = $user->restaurants()->first();
            $browser->loginAs($user->id)
                ->visit('http://localhost/e15/project3/public/favorites')
                ->assertSee($restaurant->name)
                ->click('@remove-favorite-page')
                ->assertSee('You have not added any restaurants to your favorites yet.');
        });
    }

    /**
     * test removing a restaurant from favorites by clicking the link on the restaurant page
     * @group favorites
     * @return void
     */
    public function testRemoveFromFavoritesOnRestaurantPage()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->state('withRestaurant')->create();
            $restaurant = $user->restaurants()->first();
            $browser->loginAs($user->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$restaurant->slug)
                ->assertSee($restaurant->name)
                ->click('@remove-favorite-restaurant')
                ->waitFor('.detail-filter-text')
                ->assertSee('You have not added any restaurants to your favorites yet.');
        });
    }
}
