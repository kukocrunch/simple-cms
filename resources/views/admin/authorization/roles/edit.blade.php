<x-admin.admin-master>
  
    @section('title') Edit Role : {{$role->name}} @endsection

    @section('content')
    <x-admin.content.center-content>
        <h1 class="h1 mb-4 text-gray-800">Edit Role</h1>
        @section('heading')
        Edit Role {{$role->name}}
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
            <div class="col-sm-12">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $role->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-primary btn-block">Update</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                </form>
            </div>
        </div>
        
        @if($permissions->isNotEmpty())
        <hr>
        <div class="row mt-2">
            <div class="col-sm-12">
                <h3>Permissions</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Option</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </thead>
                        <tfoot>
                            <th>Option</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tfoot>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox"
                                    @foreach($role->permissions as $role_permission)
                                        @if($role_permission->slug == $permission->slug)
                                            checked
                                        @endif
                                    @endforeach
                                    >
                                </td>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->slug }}</td>
                                <td>
                                    <form action="{{ route('roles.permission.attach', $role) }}" method="POST" display="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="permission" value="{{ $permission->id }}">
                                        <button class="btn btn-primary" type="submit"
                                        @if($role->permissions->contains($permission)) 
                                        disabled 
                                        @endif>
                                        Attach
                                        </button>
                                    </form>                            
                                </td>
                                <td>
                                    <form action="{{ route('roles.permission.detach', $role) }}" method="POST" display="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="permission" value="{{ $permission->id }}">
                                        <button class="btn btn-danger" type="submit"
                                         @if(!$role->permissions->contains($permission)) 
                                            disabled 
                                            @endif>
                                            Detach
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
        @endif

        @endsection
    </x-admin.content.center-content>
    @endsection


</x-admin.admin-master>