@extends('canidate.layout.app')
@section('title','Job Experiance')
@section('content')

{{-- add jobs --}}
<div class="modal fade show" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Job Experiance</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="company_name">Company Name</label>
          <input class="form-control" type="text" id="company_name">

          <label class="form-label" for="position">Position</label>
          <input class="form-control" type="text" id="position">

          <label class="form-label" for="start_date">Start Date</label>
          <input class="form-control" type="date" id="start_date">

          <label class="form-label" for="end_date">End Date</label>
          <input class="form-control" type="date" id="end_date">


          <button onclick="addexp()" class="btn btn-primary mt-3">Add Experiance</button>
        </div>
      </div>
    </div>
</div>
{{-- add jobs --}}



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Welcome to your Experiance</h2>
            <p>This is a simple user dashboard with left side menu and top bar menu.</p>
        </div>
        <div class="col-md-4 text-end">
            <button onclick="showModal()" type="button" class="btn btn-primary">Add Experiance</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Company Name</th>
                <th scope="col">Position</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="exp">

        </tbody>
    </table>
</div>


<script>
    getexp();
    async function getexp(){
        showLoader();
        let res = await axios.post('/canidate-get-experience');
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html += '<tr>'+
            '<th scope="row">'+element['id']+'</th>'+
            '<td>'+element['company_name']+'</td>'+
            '<td>'+element['position']+'</td>'+
            '<td>'+element['start_date']+'</td>'+
            '<td>'+element['end_date']+'</td>'+
            '<td><button class="btn btn-danger" onclick="deleteModal('+element['id']+')">Delete</button></td>'+
            '</tr>';
        });
        $('#exp').html(html);
        hideLoader();
    }

    async function addexp() {
        var company_name = $('#company_name').val();
        var position = $('#position').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        showLoader();
        let postData = new FormData();
        postData.append('company_name',company_name);
        postData.append('position',position);
        postData.append('start_date',start_date);
        postData.append('end_date',end_date);
        postData.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/canidate-create-experience',postData);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getexp();
            hideModal();
        }else{
            errorToast(res.data['message']);
        }
    }


    // modal
    function showModal(){
        $('#mymodal').modal('show');
    }
    function hideModal(){
        $('#mymodal').modal('hide');
    }
</script>


@endsection
