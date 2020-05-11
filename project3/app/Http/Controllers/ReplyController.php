<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Restaurant;
use App\Review;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
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
