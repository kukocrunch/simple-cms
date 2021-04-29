<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" width="50" height="50" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->username }}">
    <div class="media-body">
        <h5 class="mt-0">{{ $comment->user->username }}</h5> <span title="{{ $comment->created_at->format('F d, Y h:i:s A')}}">{{ $comment->created_at->diffForHumans() }}</span>
        <p>{{{$comment->body}}}</p>
        @auth
            <x-comment.reply-form :parentId="$comment->id" :postId="$comment->post_id"></x-comment.reply-form>
        @endauth


        @forelse($comment->replies as $reply)
        <x-comment.content-reply :reply="$reply"></x-comment.content-reply>
        @empty

        @endforelse
    </div>
</div>