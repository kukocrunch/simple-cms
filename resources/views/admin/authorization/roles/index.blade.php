<x-admin.admin-master>

    @section('title') Roles @endsection

    @section('content')
    <x-admin.content.full-content>
        <h1 class="h1 mb-4 text-gray-800">Roles</h1>
        @section('heading')
        Roles
        @endsection
        @section('card-body')

        <div class="row">
            <div class="col-sm-12">
                @if(Session::has('success-message'))
                <x-admin.alertbox.message type="success" message="{{ Session::get('success-message') }}"></x-admin.alertbox.message>
                @endif
                
                @if(Session::has('danger-message'))
                <x-admin.alertbox.message type="danger" message="{{ Session::get('danger-message') }}"></x-admin.alertbox.message>                
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-primary btn-block">Create</button>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tfoot>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr @if(Session::get('exist-highlight') == $role->slug) class="table-danger" @endif>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>{{$role->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>                                
                            @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>

        @endsection
    </x-admin.content.full-content>
    @endsection


</x-admin.admin-master>