<div class="mt-4 mb-3">
    <form action="{{ route('post.comment.reply') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="hidden" value="{{ $postId }}" name="post_id">
            <input type="hidden" value="{{ $parentId }}" name="parent_id">
            <textarea name="body" class="form-control" rows="3" required></textarea>
            <input type="submit" class="mt-2 btn btn-primary" value="Reply">
        </div>
    </form>
</div>