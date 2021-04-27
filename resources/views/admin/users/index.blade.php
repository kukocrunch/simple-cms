<x-admin.admin-master>
    @section('title') Users @endsection
    @section('content')
        <x-admin.content.full-content>

            @section('heading')
                Users
            @endsection

            @section('card-body')

                @if(Session::has('user-deleted'))
                <div class="alert alert-danger">
                    {{ Session::get('user-deleted') }}
                </div>
                @endif

                @if(Session::has('user-error'))
                <div class="alert alert-danger">
                    {{ Session::get('user-error') }}
                </div>
                @endif


                @if(count($users) >= 1)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Last updated</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->created_at->format('Y F d')}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                            <td>
                                @if(Auth::user()->userHasRole('admin'))
                                <a href="{{ route('user.profile.show', $user->id) }}" class="btn btn-primary" role="button">Edit</a>
                                @endif
                                <form method="post" action="{{ route('user.destroy', $user->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>


                            </td>
                            <tr>                                   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Last updated</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
                
                @else
                    <div>
                        <p>Empty Users</p>
                    </div>
                
                @endif

            @endsection
        </x-admin.content.full-content>
    @endsection

    

</x-admin.admin-master>