<?php

use App\Restaurant;
use App\User;
use Illuminate\Database\Seeder;

class RestaurantUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', '=', 'jill@harvard.edu')->first();
        $restaurants = [
            'The Cinnamon Saloon',
            'Olive Grove',
            'Little Persia'
        ];

        foreach ($restaurants as $name) {
            $restaurant = Restaurant::where('name', '=', $name)->first();
            $user->restaurants()->save($restaurant);
        }
    }
}
