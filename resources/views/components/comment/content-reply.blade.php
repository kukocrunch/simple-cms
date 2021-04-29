<div class="media mt-4">
    <img class="d-flex mr-3 rounded-circle" width="50" height="50" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->username }}">
    <div class="media-body">
        <h5 class="mt-0">{{ $reply->user->username }}</h5> <span title="{{ $reply->created_at->format('F d, Y h:i:s A')}}">{{ $reply->created_at->diffForHumans() }}</span>
        <p>{{ $reply->body }}</p>

        @auth
        <x-comment.reply-form :parentId="$reply->id" :postId="$reply->post_id"></x-comment.reply-form>
        @endauth

    </div>
</div>
@if(! $reply->replies->isEmpty())
    @foreach($reply->replies as $nestreply)
        <x-comment.content :comment="$nestreply"></x-comment.content>
    @endforeach
@endif