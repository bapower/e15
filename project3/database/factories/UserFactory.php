<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'helloworld',
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade()
    ];
});

$factory->state(User::class, 'withRestaurant', []);
$factory->afterCreatingState(User::class, 'withRestaurant', function ($user) {
    $restaurant = factory(Restaurant::class)->create();
    $user->restaurants()->sync([$restaurant->id]);
});
