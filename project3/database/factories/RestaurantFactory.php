<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'street_address' => $faker->streetAddress(),
        'city' => $faker->city(),
        'state_province' => $faker->state(),
        'country' => $faker->country(),
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade()
    ];
});
