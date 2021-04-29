<x-home-master>
    @section('content')
        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted {{$post->created_at->diffForHumans() }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ $post->post_image }}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{{ $post->body }}</p>

        <hr>

        @if(Session::has('success-message'))
          <x-admin.alertbox.message type="success" message="{{ Session::get('success-message') }}"></x-admin.alertbox.message>
        @endif

    <x-blog-post-comment :comments="$comments" :post="$post->id"></x-blog-post-comment>
    @endsection
</x-home-master>