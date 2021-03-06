<div class="restaurant-review_wrap">
    <div class="user-info">
        <p>{{ $reply->author->name }} said:</p>
        <p>{{ $reply->created_at->diffForHumans() }}</p>
        @if (!is_null(auth()->user()) && auth()->user()->id === $reply->user_id)
            <div class="bottom-icons">
                <p>
                    <a href="/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/replies/{{ $reply->id }}/delete" dusk="delete-reply"><i class="fa fa-trash"></i> Delete</a>
                </p>
            </div>
        @endif
    </div>
    <div class="user-content-wrap">
        <p class="user-text">{{ $reply->body }}</p>
    </div>
</div>
<hr>
