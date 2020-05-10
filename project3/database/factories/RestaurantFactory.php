<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    $name = $faker->words(rand(1,3), true);
    $slug = Str::slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
        'street_address' => $faker->streetAddress(),
        'city' => $faker->city(),
        'state' => $faker->state(),
        'post_code' => $faker->postcode(),
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade()
    ];
});
