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
        User::updateOrCreate(
            ['email' => 'bapower57@gmail.com', 'name' => 'Bry Power'],
            ['password' => Hash::make('123123123')
            ]);

        User::updateOrCreate(
            ['email' => 'jill@harvard.edu', 'name' => 'Jill Harvard'],
            ['password' => Hash::make('helloworld')
            ]);

        User::updateOrCreate(
            ['email' => 'jamal@harvard.edu', 'name' => 'Jamal Harvard'],
            ['password' => Hash::make('helloworld')
            ]);

        factory(User::class, 10)->create();
    }
}
