<?php

use App\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the restaurants table.
     *
     * @return void
     */
    public function run()
    {
        factory(Restaurant::class, 10)->make();
    }
}
