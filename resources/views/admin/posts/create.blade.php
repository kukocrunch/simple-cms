<x-admin-master>
    @section('content')

        <h1>Post Create</h1>
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
        <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" 
                    name="title" 
                    id="title" 
                    class="form-control" 
                    id="title" 
                    placeholder="Title">
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input type="file" 
                    name="post_image" 
                    class="form-control-file"
                    id="post_image">
            </div>

            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
            </div>

            <input type="submit" class="btn btn-primary" value="Submit">
        </form>

    @endsection
</x-admin-master>