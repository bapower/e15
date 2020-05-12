<?php

namespace Tests\Browser;

use App\Restaurant;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RestaurantsTest extends DuskTestCase
{
    /**
     * test a restaurant is visible in restaurant index
     * @group restaurant
     * @return void
     */
    public function testSeeRestaurantInRestaurantIndex()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = factory(Restaurant::class)->create();
            $browser->visit('http://localhost/e15/project3/public/restaurants')
                    ->assertSee($restaurant->name);
        });
    }

    /**
     * test restaurant is visible in restaurant page
     * @group restaurant
     * @return void
     */
    public function testShowRestaurant()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = factory(Restaurant::class)->create();
            $browser->visit('http://localhost/e15/project3/public/restaurants/'.$restaurant->slug)
                ->assertSee($restaurant->name);
        });
    }

    /**
     * test search for a restaurant
     * @group restaurant
     * @return void
     */
    public function testSearchForRestaurant()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = factory(Restaurant::class)->create();
            $browser->visit('http://localhost/e15/project3/public/')
                ->type('searchTerms', $restaurant->name)
                ->click('@search-button')
                ->assertSee($restaurant->name);
        });
    }

    /**
     * test search for a restaurant but it is not found
     * @group restaurant
     * @return void
     */
    public function testSearchForRestaurantNotFound()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost/e15/project3/public/')
                ->type('searchTerms', 'Not a restaurant')
                ->click('@search-button')
                ->assertSee('0 restaurants found for search');
        });
    }
}
