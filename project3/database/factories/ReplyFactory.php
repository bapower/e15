<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use App\Review;
use App\User;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->make();
        },
        'review_id' => function () {
            return factory(Review::class)->create()->id;
        },
        'body' => $faker->paragraphs(rand(1,3), true),
        'created_at' => $faker->dateTimeThisMonth(),
        'updated_at' => $faker->dateTimeThisMonth()
    ];
});
