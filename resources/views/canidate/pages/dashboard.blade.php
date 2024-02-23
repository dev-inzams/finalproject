@extends('canidate.layout.app')
@section('title','User Dashboard')
@section('content')

<div class="row">
    <div class="col-md-12">
      <h2>Welcome to your Dashboard</h2>
      <p>This is a simple user dashboard with left side menu and top bar menu.</p>
    </div>

        <div class="modal fade show" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content border-normal">
                <div class="modal-header">
                  <h1 class="modal-title fs-4" id="exampleModalLgLabel">Large modal</h1>
                  <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
              </div>
            </div>
        </div>


</div>
<button onclick="successToast('Tostify')">Tostify</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" onclick="deleteModal(1)">
    Launch demo modal
</button>
<script>
    hideModal();
    function hideModal(){
        document.getElementById('mymodal').style.display = 'none';
    }

    function showModal(){
        document.getElementById('mymodal').style.display = 'block';
    }

</script>
@endSection
