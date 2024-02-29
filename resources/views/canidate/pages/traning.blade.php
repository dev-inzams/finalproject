@extends('canidate.layout.app')
@section('title','Job Experiance')
@section('content')

{{-- add jobs --}}
<div class="modal fade show" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Traning</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="training_name">Traning Name</label>
          <input class="form-control" type="text" id="training_name">

          <label class="form-label" for="institute">Institute</label>
          <input class="form-control" type="text" id="institute">


          <label class="form-label" for="end_date">End Date</label>
          <input class="form-control" type="date" id="end_date">


          <button onclick="addtraning()" class="btn btn-primary mt-3">Add Traning</button>
        </div>
      </div>
    </div>
</div>
{{-- add jobs --}}



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Welcome to your Traning</h2>
            <p>This is a simple user dashboard with left side menu and top bar menu.</p>
        </div>
        <div class="col-md-4 text-end">
            <button onclick="showModal()" type="button" class="btn btn-primary">Add Traning</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Traning Name</th>
                <th scope="col">Institute</th>
                <th scope="col">End Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="traning">

        </tbody>
    </table>
</div>


<script>

     // add
     async function addtraning(){
        let training_name = document.getElementById('training_name').value;
        let institute = document.getElementById('institute').value;
        let end_date = document.getElementById('end_date').value;
        showLoader();
        let postdata = new FormData();
        postdata.append('training_name',training_name);
        postdata.append('institute',institute);
        postdata.append('end_date',end_date);
        postdata.append('_token','{{ csrf_token() }}');

        let res = await axios.post('/canidate-create-traning',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await gettraning();
            hideModal();
        }else{
            errorToast(res.data['message']);
        }

    }


    gettraning();
    async function gettraning(){
        showLoader();
        let res = await axios.post('/canidate-get-traning');
        hideLoader();
            if(res.data['status'] == 'success'){

                let data = res.data['data'];
                let html = '';
                data.forEach(element => {
                    html += `<tr>
                    <th scope="row">${element['id']}</th>
                    <td>${element['training_name']}</td>
                    <td>${element['institute']}</td>

                    <td>${element['end_date']}</td>
                    <td><button class="btn btn-danger" onclick="deletetraining(${element['id']})">Delete</button></td>
                </tr>`
                });
                $('#traning').html(html);

            }else{
                errorToast(res.data['message']);
            }
    }

    // modal
    function hideModal(){
        document.getElementById('mymodal').style.display = 'none';
    }

    function showModal(){
        document.getElementById('mymodal').style.display = 'block';
    }




</script>
@endsection
