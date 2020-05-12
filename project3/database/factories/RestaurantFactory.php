<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    $name = $faker->words(rand(1,2), true);
    $slug = Str::slug($name, '-');
    return [
        'name' => Str::title($name),
        'slug' => $slug,
        'street_address' => $faker->streetAddress(),
        'city' => $faker->city(),
        'state' => $faker->state(),
        'post_code' => $faker->postcode(),
        'phone_number' => $faker->phoneNumber(),
        'url' => $faker->url,
        'rating' => rand(1,10),
        'cost_rating' => rand(1,5),
        'tagline' => $faker->sentence(),
        'description' => $faker->paragraphs(rand(2,4), true),
        'image' => '/images/restaurants/restaurant_default.jpg',
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade()
    ];
});
