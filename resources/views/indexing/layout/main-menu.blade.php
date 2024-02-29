<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="{{ route('index') }}">Your Logo</a>

      <!-- Navbar toggle button for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>

        <!-- Sign-in and Sign-up buttons -->
        <div class="d-flex">
            @if (cookie('token') == '')
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2" type="button">Sign In</a>
                <a href="{{ route('registration') }}" class="btn btn-primary" type="button">Sign Up</a>
            @elseif (cookie('token') != '')
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2" type="button">Dashboard</a>
            @endif
        </div>
      </div>
    </div>
  </nav>
