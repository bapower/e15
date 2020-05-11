<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RestaurantTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(ReplyTableSeeder::class);
        $this->call(RestaurantUserTableSeeder::class);
    }
}
