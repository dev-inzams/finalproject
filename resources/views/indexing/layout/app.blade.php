<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap 5 Navbar</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- tostify --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('tostify/style.css') }}">
  <script src="{{ asset('tostify/main.js') }}"></script>
 {{-- axios --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js" integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  {{-- preloader --}}
  <link rel="stylesheet" href="{{ asset('preloader/style.css') }}">
  <script src="{{ asset('preloader/app.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  {{-- font awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>@yield('title')</title>
</head>
<body class="bg-dark">
    <div id="toast-container"></div>
    @include('components.preloader.border')
    @include('indexing.layout.main-menu')


@yield('content')


@include('indexing.layout.footer')
<!-- Bootstrap JS (optional, if you want to use Bootstrap JavaScript components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    // Delete Modal
    function deleteModal(id){
        document.getElementById('deleteModal').style.display = 'block';
        document.getElementById('confirmDelete').setAttribute('data-id',id);
    }

    function hideDelete(){
        document.getElementById('deleteModal').style.display = 'none';
        document.getElementById('confirmDelete').setAttribute('data-id',0);
    }
</script>
</body>
</html>
