<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the user table.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->make();
    }
}
