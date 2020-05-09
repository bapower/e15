<?php

use App\Reply;
use Illuminate\Database\Seeder;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the reply table.
     *
     * @return void
     */
    public function run()
    {
        factory(Reply::class, 10)->make();
    }
}
