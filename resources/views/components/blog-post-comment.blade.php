<!-- Comments Form -->
<div class="card my-4">
    <h5 class="card-header">Leave a Comment:</h5>
    <div class="card-body">
        @auth
        <form action="{{ route('post.comment.store', $post) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea class="form-control @error('body') is-invalid @enderror" rows="3" name="body"></textarea>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>               
        @endauth
        @guest
            <a href="{{ route('login') }}">Login</a> first to leave a comment
        @endguest
    </div>
</div>


@forelse ($comments as $comment)

<x-comment.content :comment="$comment"></x-comment.content>

@empty


    <div class="my-5">
        No comments found. Be first to comment!
    </div>

@endforelse