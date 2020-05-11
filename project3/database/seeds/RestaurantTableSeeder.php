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
        $restaurantNames = preg_replace('/\r|\n/', "", file_get_contents(database_path('restaurants.csv')));
        $restaurantNames = str_getcsv($restaurantNames);

        $faker = Faker\Factory::create();
        foreach ($restaurantNames as $name) {
            $slug = Str::slug($name, '-');
            $restaurant = new Restaurant();

            $restaurant->name = $name;
            $restaurant->slug = $slug;
            $restaurant->street_address = $faker->streetAddress();
            $restaurant->city = $faker->city();
            $restaurant->state = $faker->state();
            $restaurant->post_code = $faker->postcode();
            $restaurant->created_at = $faker->dateTimeThisDecade();
            $restaurant->updated_at = $faker->dateTimeThisDecade();

            $restaurant->save();
        }

        factory(Restaurant::class, 10)->make();
    }
}
