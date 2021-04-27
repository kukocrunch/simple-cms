<x-admin.admin-master>
    @section('title') Posts @endsection
    @section('content')
        <x-admin.content.full-content>
            <h1 class="h1 mb-4 text-gray-800">Posts</h1>
            @section('heading')
            All active post entries
            @endsection
            @section('card-body')
                @if(Session::has('message'))
                <div class="alert alert-danger">
                    {{ Session::get('message') }}
                </div>
        
                @elseif(Session::has('created-message'))
                <div class="alert alert-success">
                    {{ Session::get('created-message') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Posted by</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Posted by</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td> <a href="{{ route('admin.post.edit', $post->id) }}"> {{$post->id}} </a></td>
                            <th>{{ $post->user->name }}</th>
                            <td>{{ $post->title }}</td>
                            <td>
                            <img height="40px" src="{{ $post->post_image }}" alt="{{ $post->title }}">
                            </td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ $post->updated_at->diffForHumans() }}</td>
                            <td>
                                <div>
                                <button  class="d-inline btn btn-primary">
                                    <a href="{{ route('admin.post.edit', $post->id) }}" class="text-white text-decoration-none">Edit</a>                        
                                </button>
                                <form action="{{route('admin.post.destroy', $post->id)}}" method="POST" class="d-inline" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>            
            @endsection
        </x-admin.content.full-content>
    @endsection

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/datatables-script.js') }}"></script>
    @endsection

</x-admin.admin-master>