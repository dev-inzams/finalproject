@extends('canidate.layout.app')
@section('title','User Dashboard')
@section('content')

{{-- add jobs --}}
<div class="modal fade show" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Jobs</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="degree">Degree</label>
          <input class="form-control" type="text" id="degree">

          <label class="form-label" for="institute">Institute</label>
          <input class="form-control" type="text" id="institute">

          <label class="form-label" for="department">Department</label>
          <input class="form-control" type="text" id="department">

          <label class="form-label" for="result">Result</label>
          <input class="form-control" type="text" id="result">

          <label class="form-label" for="category">Passing Year</label>
          <input class="form-control" type="text" id="passing_year">

          <button onclick="addedu()" class="btn btn-primary mt-3">Add Jobs</button>
        </div>
      </div>
    </div>
</div>
{{-- add jobs --}}



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Welcome to your Education</h2>
            <p>This is a simple user dashboard with left side menu and top bar menu.</p>
        </div>
        <div class="col-md-4 text-end">
            <button onclick="showModal()" type="button" class="btn btn-primary">Add Education</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Degree</th>
                <th scope="col">Institute</th>
                <th scope="col">Department</th>
                <th scope="col">Result</th>
                <th scope="col">Passing Year</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="edu">

        </tbody>
    </table>
</div>

<script>
    getEdu();
    async function getEdu(){
        let res = await axios.post('/canidate-get-education');
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html += '<tr>'+
            '<th scope="row">'+element['id']+'</th>'+
            '<td>'+element['degree']+'</td>'+
            '<td>'+element['institute']+'</td>'+
            '<td>'+element['department']+'</td>'+
            '<td>'+element['result']+'</td>'+
            '<td>'+element['passing_year']+'</td>'+
            '<td><button class="btn btn-danger" onclick="deleteModal('+element['id']+')">Delete</button></td>'+
            '</tr>';
        });
        $('#edu').html(html);
    }

    async function addedu(){
        let degree = $('#degree').val();
        let institute = $('#institute').val();
        let department = $('#department').val();
        let result = $('#result').val();
        let passing_year = $('#passing_year').val();
        showLoader();
        let postdata = new FormData();
        postdata.append('degree',degree);
        postdata.append('institute',institute);
        postdata.append('department',department);
        postdata.append('result',result);
        postdata.append('passing_year',passing_year);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/canidate-create-education',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            location.reload();
        }else{
            errorToast(res.data['message']);
        }
    }

    async function confirmDelete() {
        var id = $('#confirmDelete').data('id');
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/canidate-destroy-education',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            hideDelete();
            successToast(res.data['message']);
            await getEdu();
        }else{
            errorToast(res.data['message']);
        }
    }

// modal function
    function showModal(){
        document.getElementById('mymodal').style.display = 'block';
    }
    function hideModal(){
        document.getElementById('mymodal').style.display = 'none';

    }
</script>

@endsection
