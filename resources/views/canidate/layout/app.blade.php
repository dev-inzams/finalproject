<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('canidate/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('canidate/css/modal.css') }}">

  {{-- tostify --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('tostify/style.css') }}">
  <script src="{{ asset('tostify/main.js') }}"></script>
 {{-- axios --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js" integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  {{-- preloader --}}
  <link rel="stylesheet" href="{{ asset('preloader/style.css') }}">
  <script src="{{ asset('preloader/app.js') }}"></script>
</head>
<body>

@include('components.modal.delete')

<!-- Sidebar -->
@include('canidate.layout.sidebar')

<!-- Top Bar -->
@include('canidate.layout.topbar')

<!-- Content -->
<div id="toast-container"></div>
<div class="content">
  <div class="container">
    @include('components.preloader.border')
    @yield('content')
  </div>
</div>



<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<script>

    // Delete Modal
    function deleteModal(id){
        document.getElementById('deleteModal').style.display = 'block';
        document.getElementById('confirmDelete').setAttribute('data-id',id);
    }
    function confirmDelete(){
        document.getElementById('deleteModal').style.display = 'none';
        document.getElementById('confirmDelete').setAttribute('data-id',0);
    }
    function hideDelete(){
        document.getElementById('deleteModal').style.display = 'none';
        document.getElementById('confirmDelete').setAttribute('data-id',0);
    }
</script>

</body>
</html>
