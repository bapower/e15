<div class="customer-review_wrap">
    <div class="customer-img">
        <p>{{ $reply->author->name }} said:</p>
        <p>{{ $reply->created_at->diffForHumans() }}</p>
        @if (!is_null(auth()->user()) && auth()->user()->id === $reply->user_id)
            <div class="bottom-icons">
                <p>
                    <a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/delete"><i class="fa fa-trash"></i> Delete</a>
                </p>
            </div>
        @endif
    </div>
    <div class="customer-content-wrap">
        <p class="customer-text">{{ $reply->body }}</p>
    </div>
</div>
<hr>
