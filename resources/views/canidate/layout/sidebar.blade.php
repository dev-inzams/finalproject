<div class="sidebar mt-5">
    <ul>
      <li class="@if (Route::currentRouteName() == 'canidate-dashboard') active @endif"><a href="{{ route('canidate-dashboard') }}">Dashboard</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-profile') active @endif"><a href="{{ route('canidate-profile')}}">Profile</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-education') active @endif"><a href="{{ route('canidate-education')}}">Education</a></li>
      <li><a href="#">Settings</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
