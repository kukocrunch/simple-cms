<x-admin.admin-master>
    @section('title') Create New Post @endsection

    @section('content')
    <x-admin.content.full-content>
        @section('heading')
        Post Create
        @endsection
        @section('card-body')
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
                        class="form-control @error('title') is-invalid @enderror" 
                        id="title" 
                        placeholder="Title">
                    @error('title') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" 
                        name="post_image" 
                        class="form-control-file"
                        id="post_image">
                </div>
    
                <div class="form-group">
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body" cols="30" rows="10"></textarea>
                    @error('body') 
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
            @endsection
    </x-admin.content.full-content>
    @endsection
</x-admin.admin-master>