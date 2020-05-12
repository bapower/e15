<?php

namespace Tests\Browser;

use App\Reply;
use App\Review;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RepliesTest extends DuskTestCase
{
    /**
     * test writing a reply
     * @group reply
     * @return void
     */
    public function testWriteAReply()
    {
        $this->browse(function (Browser $browser) {
            $review = factory(Review::class)->create();
            $browser->loginAs($review->author->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$review->restaurant->slug .'/reviews/'.$review->id)
                ->type('body', 'A very interesting reply')
                ->scrollIntoView('@post-reply')
                ->press('@post-reply')
                ->assertSee('A very interesting reply');
        });
    }

    /**
     * test writing a reply with blank field
     * @group reply
     * @return void
     */
    public function testWriteAReplyBlankField()
    {
        $this->browse(function (Browser $browser) {
            $review = factory(Review::class)->create();
            $browser->loginAs($review->author->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$review->restaurant->slug .'/reviews/'.$review->id)
                ->type('body', '')
                ->scrollIntoView('@post-reply')
                ->press('@post-reply')
                ->assertSee('The body field is required.');
        });
    }

    /**
     * Delete a reply
     * @group reply
     * @return void
     */
    public function testDeleteReply()
    {
        $this->browse(function (Browser $browser) {
            $reply = factory(Reply::class)->create();
            $browser->loginAs($reply->author->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$reply->review->restaurant->slug .'/reviews/'.$reply->review->id)
                ->scrollIntoView('@delete-reply')
                ->click('@delete-reply')
                ->assertDontSee($reply->body);
        });
    }
}
