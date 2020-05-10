<?php

namespace App\Http\Controllers;

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
}
