@foreach ($productDetail->comments as $comment)
<div class="review_item">
    <div class="media">
        <div class="d-flex">
            <img src="{{ asset($comment->user->avatar) }}" alt="" />
        </div>
        <div class="media-body">
            <h4>{{ $comment->user->firstname }} {{ $comment->user->lastname }}</h4>
            <h5>{{ Carbon\Carbon::createFromTimestamp($comment->created_at)->toDateTimeString() }}</h5>
        </div>
    </div>
    <p>{{ $comment->content }}</p>
</div>
@endforeach
