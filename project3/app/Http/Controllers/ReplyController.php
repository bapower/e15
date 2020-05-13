<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * save a reply
     *
     * @param string $restaurantSlug
     * @param Review $review
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(string $restaurantSlug, Review $review)
    {
        $this->validate(request(), [
            'body' => 'required'
        ]);
        $review->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back()->with([
            'flash-alert' => 'Your reply added'
        ]);
    }

    /**
     * remove the reply from the review
     *
     * @param string $restaurantSlug
     * @param int $reviewId
     * @param int $replyId
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(string $restaurantSlug, int $reviewId, int $replyId)
    {
        $reply = Reply::find($replyId);
        $reply->delete();

        return redirect('/restaurants/' . $restaurantSlug . '/reviews/'. $reviewId)->with([
            'flash-alert' => 'Your reply was deleted'
        ]);
    }
}
