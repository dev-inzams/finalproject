<div class="sidebar mt-5">
    <ul>
      <li class="@if (Route::currentRouteName() == 'dashboard') active @endif"><a href="{{ route('dashboard')}}">Dashboard</a></li>
      <li class="@if (Route::currentRouteName() == 'admin-profile') active @endif"><a href="{{ route('admin-profile')}}">Profile</a></li>
      <li class="@if (Route::currentRouteName() == 'admin-jobs-control') active @endif"><a href="{{ route('admin-jobs-control')}}">Jobs Control</a></li>
      <li class="@if (Route::currentRouteName() == 'admin-categories-control') active @endif"><a href="{{ route('admin-categories-control')}}">Categories</a></li>
      <li class="@if (Route::currentRouteName() == 'admin-posts-control') active @endif"><a href="{{ route('admin-posts-control')}}">Posts</a></li>
      <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
  </div>
