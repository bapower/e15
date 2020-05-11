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
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade()
    ];
});
