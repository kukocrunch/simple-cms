<x-admin.admin-master>

    @section('title') Permissions @endsection

    @section('content')
    <x-admin.content.center-content>
        <h1 class="h1 mb-4 text-gray-800">Permissions</h1>
        @section('heading')
        Permissions
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
                <form action="{{ route('permissions.update', $permission) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $permission->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="mt-3 btn btn-primary btn-block">Update</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                </form>
            </div>
        </div>
        @endsection
    </x-admin.content.center-content>
    @endsection


</x-admin.admin-master>