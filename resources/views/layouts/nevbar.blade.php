<div class="logo">
   <a href="{{route('admin.main')}}" class="simple-text logo-normal"><img class="rounded-circle" src="{{asset('storage/admin/'.Auth::guard('admin')->user()->image)}}" width="50px" /> {{Auth::Guard('admin')->user()->name}}</a>
</div>
<div class="sidebar-wrapper">
   <ul class="nav">
      <li class="nav-item {{ request()->is('*admin/dashboard/content*') ? 'active' : '' }}">
         <a class="nav-link" href="{{route('admin.main')}}">
            <i class="material-icons">dashboard</i>
            <p>{{ trans('Dashboard') }}</p>
         </a>
      </li>
      <li class="nav-item {{ request()->is('*list-user*') ? 'active' : '' }}">
         <a class="nav-link" href="{{route('admin.list_user')}}">
            <i class="material-icons">person</i>
            <p>User List</p>
         </a>
      </li>
      <!-- <li class="nav-item {{ request()->is('*list-point*') ? 'active' : '' }}">
         <a class="nav-link" href="{{route('admin.list_point')}}">
            <i class="material-icons">person</i>
            <p>Point Details</p>
         </a>
      </li> -->
      <li class="nav-item {{ request()->is('*list-point*') ? 'active' : '' }}">
         <a class="nav-link" href="{{route('admin.point_list')}}">
            <i class="material-icons">person</i>
            <p>Point Details</p>
         </a>
      </li>
   </ul>