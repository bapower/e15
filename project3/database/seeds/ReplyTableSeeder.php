<?php

use App\Reply;
use Illuminate\Database\Seeder;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds for the replies table.
     *
     * @return void
     */
    public function run()
    {
        factory(Reply::class, 10)->make();
//        $reply = new Reply();
//        $reply->user_id = 1;
//        $reply->review_id = 1;
//        $reply->body = 'Laravel Partners are elite shops providing top-notch Laravel development and consulting. Each of our partners can help you craft a beautiful, well-architected project.';
//        $reply->created_at = '2011-05-11 04:52:47';
//        $reply->updated_at = '2011-05-11 04:52:47';
//
//        $reply->save();
    }
}
