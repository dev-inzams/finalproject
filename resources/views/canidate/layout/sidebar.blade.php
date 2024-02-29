<div class="sidebar mt-5">
    <ul>
      <li class="@if (Route::currentRouteName() == 'dashboard') active @endif"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-profile') active @endif"><a href="{{ route('canidate-profile')}}">Profile</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-education') active @endif"><a href="{{ route('canidate-education')}}">Education</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-experience') active @endif"><a href="{{ route('canidate-experience')}}">Experiance</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-traning') active @endif"><a href="{{ route('canidate-traning') }}">Traning</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-skils') active @endif"><a href="{{ route('canidate-skils') }}">Skils</a></li>
      <li class="@if (Route::currentRouteName() == 'canidate-jobs') active @endif"><a href="{{ route('canidate-jobs') }}">Jobs</a></li>
      <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
  </div>
