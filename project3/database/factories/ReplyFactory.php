<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use App\Review;
use App\User;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
//    return [
//        'user_id' => function () {
//            return factory(User::class)->create()->id;
//        },
//        'review_id' => function () {
//            return factory(Review::class)->create()->id;
//        },
//        'body' => $faker->paragraph(),
//        'created_at' => $faker->dateTimeThisDecade(),
//        'updated_at' => $faker->dateTimeThisDecade()
//    ];
    return [
        'user_id' => 1,
        'review_id' => 1,
        'body' => 'Laravel Partners are elite shops providing top-notch Laravel development and consulting. Each of our partners can help you craft a beautiful, well-architected project.',
        'created_at' => '2011-05-11 04:52:47',
        'updated_at' => '2011-05-11 04:52:47'
    ];
});
