<div class="card">
    <div class="card-header">
        <a href="#">
            {{ $reply->author->name }} said {{ $reply->created_at->diffForHumans() }} ...
        </a>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
    @if (auth()->user()->id === $reply->user_id)
        <div class="card-footer">
            <ul class="list-group">
                <li class="list-group-item"><a href="http://localhost/e15/project3/public/restaurants/{{ $restaurant->slug }}/reviews/{{ $review->id }}/replies/{{ $reply->id }}/delete"><i class="fa fa-trash"></i> Delete</a></li>
            </ul>
        </div>
    @endif
</div>
