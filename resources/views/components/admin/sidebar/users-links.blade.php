<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
      <i class="fas fa-fw fa-user"></i>
      <span>Users</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Users:</h6>
        {{-- <a class="collapse-item" href="{{route('admin.post.create')}}">Create a User</a> --}}
        <a class="collapse-item" href="{{route('users.index')}}">Users List</a>
      </div>
    </div>
  </li>