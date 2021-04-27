<x-admin.admin-master>

    @section('title') Profile {{ $user->name }} @endsection

    @section('content')
    <x-admin.content.center-content>
    @section('heading')
        User Profile
    @endsection

    @section('card-body')
    <div>
        <form method="POST" action="{{ route('user.profile.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="mb-4">
                <img class="img-profile rounded-circle" width="60" src="{{ $user->avatar }}">
            </div>
            
            <div class="form-group">
                <input type="file" name="avatar" id="" class="form-control-file">
                @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" value="{{$user->username}}">
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror        
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{$user->name}}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{$user->email}}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation " placeholder="Confirm Password" >
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>        
    </div>

    @if (Auth::user()->userHasRole('Admin'))
    <div class="mt-5">
        <p>ROLES</p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Attach</th>
                        <th>Detach</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Option</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Attach</th>
                        <th>Detach</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td><input type="checkbox"
                            @foreach($user->roles as $user_role)
                                @if($user_role->slug == $role->slug)
                                    checked
                                @endif
                            @endforeach
                            ></td>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->slug }}</td>
                        <td>
                            <form action="{{route('user.role.attach', $user)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{ $role->id }}">
                                <button class="btn btn-primary"
                                    @if($user->roles->contains($role))
                                        disabled
                                    @endif>
                                    Attach
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('user.role.detach', $user)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{ $role->id }}">
                                <button class="btn btn-danger"
                                            @if(!$user->roles->contains($role))
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
    @endif

    @endsection
    </x-admin.content.center-content>
    @endsection
</x-admin.admin-master>