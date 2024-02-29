@extends('admin.layout.app')
@section('title','User Dashboard')
@section('content')




<div class="row">
    <div class="col-md-12">
      <h2>Welcome to your Dashboard</h2>
      <p>This is a simple user dashboard with left side menu and top bar menu.</p>
    </div>
    <button onclick="deleteModal('1')">Delete</button>
</div>
<script>
    function hideModal(){
        document.getElementById('mymodal').style.display = 'none';
    }

    function showModal(){
        document.getElementById('mymodal').style.display = 'block';
    }
</script>
@endSection
