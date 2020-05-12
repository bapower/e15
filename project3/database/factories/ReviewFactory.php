<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use App\Review;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Review::class, function (Faker $faker) {
    $title = $faker->words(rand(3, 6), true);
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'restaurant_id' => function () {
            return factory(Restaurant::class)->create()->id;
        },
        'title' => Str::title($title),
        'body' => $faker->paragraphs(rand(2, 6), true),
        'image' => 'http://www.lorempixel.com/640/480/food/',
        'rating' => rand(1,10),
        'created_at' => $faker->dateTimeThisYear(),
        'updated_at' => $faker->dateTimeThisYear(),
    ];
});
