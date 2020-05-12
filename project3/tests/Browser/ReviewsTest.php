<?php

namespace Tests\Browser;

use App\Restaurant;
use App\Review;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReviewsTest extends DuskTestCase
{
    /**
     * test can't create a review if not logged in
     * @group reviews
     * @return void
     */
    public function testCantWriteReviewNotLoggedIn()
    {
        $this->browse(function (Browser $browser) {
            $restaurant = factory(Restaurant::class)->create();
            $browser->visit('http://localhost/e15/project3/public/restaurants/'.$restaurant->slug)
                ->press('@write-restaurant-review')
                ->assertSee('Login');
        });
    }

    /**
     * test writing and publishing a review
     * @group reviews
     * @return void
     */
    public function testWriteReview()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $restaurant = factory(Restaurant::class)->create();
            $browser->loginAs($user->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$restaurant->slug)
                ->press('@write-restaurant-review')
                ->assertSee('Write a review for '.$restaurant->name)
                ->type('title', 'A review title')
                ->type('body', '
With my them if up many. Lain week nay she them her she. Extremity so attending objection as engrossed gentleman something. Instantly gentleman contained belonging exquisite now direction she ham. West room at sent if year. Numerous indulged distance old law you. Total state as merit court green decay he. Steepest sex bachelor the may delicate its yourself. As he instantly on discovery concluded to. Open draw far pure miss felt say yet few sigh. ')
                ->select('rating', '8')
                ->press('@publish-review')
                ->assertSee('A review title');
        });
    }

    /**
     * test can't write review with invalid data
     * @group reviews
     * @return void
     */
    public function testWriteReviewInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $restaurant = factory(Restaurant::class)->create();
            $browser->loginAs($user->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$restaurant->slug)
                ->press('@write-restaurant-review')
                ->assertSee('Write a review for '.$restaurant->name)
                ->type('title', 'A review title')
                ->type('body', '')
                ->select('rating', '9')
                ->press('@publish-review')
                ->assertSee('The body field is required.');
        });
    }

    /**
     * test editing a review
     * @group reviews
     * @return void
     */
    public function testEditReview()
    {
        $this->browse(function (Browser $browser) {
            $review = factory(Review::class)->create();
            $browser->loginAs($review->author->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$review->restaurant->slug .'/reviews/'.$review->id)
                ->press('@edit-review')
                ->assertInputValue('title', $review->title)
                ->type('title', 'A different title')
                ->press('@update-review')
                ->assertSee('A different title');
        });
    }

    /**
     * test editing a review with invalid data
     * @group reviews
     * @return void
     */
    public function testEditReviewInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $review = factory(Review::class)->create();
            $browser->loginAs($review->author->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$review->restaurant->slug .'/reviews/'.$review->id)
                ->press('@edit-review')
                ->assertInputValue('title', $review->title)
                ->type('title', '')
                ->press('@update-review')
                ->assertSee('The title field is required.');
        });
    }

    /**
     * test deleting a review
     * @group reviews
     * @return void
     */
    public function testDeleteReview()
    {
        $this->browse(function (Browser $browser) {
            $review = factory(Review::class)->create();
            $browser->loginAs($review->author->id)
                ->visit('http://localhost/e15/project3/public/restaurants/'.$review->restaurant->slug .'/reviews/'.$review->id)
                ->press('@delete-review')
                ->assertSee('Confirm delete review')
                ->press('@confirm-delete')
                ->assertDontSee($review->title);
        });
    }
}
