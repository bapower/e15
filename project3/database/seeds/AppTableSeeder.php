<?php

use App\Restaurant;
use App\Review;
use Illuminate\Database\Seeder;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

            factory(Review::class, rand(0, 5))->create(['restaurant_id' => $restaurant->id, 'user_id' => rand(1,3)])->each(function ($review) {
                for ($i = 1; $i <= rand(1,5); $i++) {
                    $review->replies()->save(factory(App\Reply::class)->create(['review_id' => $review->id, 'user_id' => rand(1,3)]));
                }
            });
        }
    }
}
