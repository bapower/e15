<?php

use App\Review;
use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the reviews table.
     *
     * @return void
     */
    public function run()
    {
        factory(Review::class, 10)->make();
//        factory(App\Review::class, 10)->create()->each(function ($review) {
//            $review->replies()->save(factory(App\Reply::class)->make());
//        });
    }
}
