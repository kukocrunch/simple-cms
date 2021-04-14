<x-admin-master>
    @section('content')

        <h1>Edit Post</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            Invalid post please see errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('admin.post.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" 
                    name="title" 
                    id="title" 
                    class="form-control" 
                    value="{{ $post->title }}"
                    id="title" 
                    placeholder="Title">
            </div>

            <div class="form-group">
                @if($post->post_image)
                <img src="{{ $post->post_image }}" height="100px">
                @endif

                <label for="file">File</label>
                <input type="file" 
                    name="post_image" 
                    class="form-control-file"
                    id="post_image">
            </div>

            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ $post->body }}</textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Submit">
        </form>

    @endsection
</x-admin-master>