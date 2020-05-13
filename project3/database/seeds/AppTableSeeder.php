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
        foreach ($restaurantNames as $i =>$name) {
            $slug = Str::slug($name, '-');
            $restaurant = new Restaurant();

            $restaurant->name = $name;
            $restaurant->slug = $slug;
            $restaurant->street_address = $faker->streetAddress();
            $restaurant->city = $faker->city();
            $restaurant->state = $faker->state();
            $restaurant->post_code = $faker->postcode();
            $restaurant->phone_number = $faker->phoneNumber();
            $restaurant->url = 'http://www.' . $slug . '.com/';
            $restaurant->rating = rand(3,10);
            $restaurant->cost_rating = rand(1,5);
            $restaurant->tagline = $faker->sentence();
            $restaurant->description = $faker->paragraphs(rand(2,4), true);
            $restaurant->image = '/images/restaurants/restaurant' . ($i+1) . '.jpg';
            $restaurant->created_at = $faker->dateTimeThisDecade();
            $restaurant->updated_at = $faker->dateTimeThisDecade();

            $restaurant->save();

            for ($i = 1; $i <= rand(1,20); $i++) {
                $review = factory(Review::class)->create(['restaurant_id' => $restaurant->id, 'user_id' => rand(1,13)]);
                for ($i = 1; $i <= rand(1,5); $i++) {
                    $review->replies()->save(factory(App\Reply::class)->create(['review_id' => $review->id, 'user_id' => rand(1,13)]));
                }
            }

        }
    }
}
