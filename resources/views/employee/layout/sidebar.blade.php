<div class="sidebar mt-5">
    <ul>
      <li class="@if (Route::currentRouteName() == 'dashboard') active @endif"><a href="{{ route('dashboard')}}">Dashboard</a></li>
      <li class="@if (Route::currentRouteName() == 'employee-profile') active @endif"><a href="{{ route('employee-profile')}}">Profile</a></li>
      <li class="@if (Route::currentRouteName() == 'employee-jobs') active @endif"><a href="{{ route('employee-jobs') }}">Jobs</a></li>
      <li class="@if (Route::currentRouteName() == 'employee-company') active @endif"><a href="{{ route('employee-company')}}">Company</a></li>
      <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
  </div>
