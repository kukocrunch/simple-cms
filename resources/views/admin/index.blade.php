<x-admin.admin-master>

    @section('title')
    Dashboard
    @endsection

    @section('content')

    <x-admin.content.center-content>
        @section('heading') Dashboard @endsection

        @section('card-body')
            @if(auth()->user()->userHasRole('admin'))
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
            @endif

            @if(Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif

            <p>Welcome to simple-cms!</p>
            <p>To get started, select the menu actions you wanted.</p>
        
        @endsection
    </x-admin.content.center-content>

    @endsection
</x-admin.admin-master>