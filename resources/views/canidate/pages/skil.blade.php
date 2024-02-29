@extends('canidate.layout.app')
@section('title','Job Experiance')
@section('content')

{{-- add jobs --}}
<div class="modal fade show" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Skils</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="name">Name</label>
          <input class="form-control" type="text" id="name">

          <label class="form-label" for="level">Level</label>
          <select id="level" class="form-control">
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="expert">Expert</option>
          </select>




          <button onclick="addskil()" class="btn btn-primary mt-3">Add skill</button>
        </div>
      </div>
    </div>
</div>
{{-- add jobs --}}



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Welcome to your Skils</h2>
            <p>This is a simple user dashboard with left side menu and top bar menu.</p>
        </div>
        <div class="col-md-4 text-end">
            <button onclick="showModal()" type="button" class="btn btn-primary">Add Skils</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Lavel</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="skils">

        </tbody>
    </table>
</div>


<script>

    getskil();
    async function getskil(){
        showLoader();
        let res = await axios.post('/canidate-get-skil');

        hideLoader();
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html += '<tr><td>'
                +element['id']+
                '</td><td style="text-transform:uppercase">'
                    +element['name']+
                    '</td><td style="text-transform:capitalize">'
                        +element['level']+
                        '</td><td><button class="btn btn-danger" onclick="deleteModal('+element['id']+')">Delete</button></td></tr>';
        });
        document.getElementById('skils').innerHTML = html;
    }


    async function addskil(){
        var name = document.getElementById('name').value;
        var level = document.getElementById('level').value;

        let postdata = new FormData();
        postdata.append('name',name);
        postdata.append('level',level);
        postdata.append('_token','{{ csrf_token() }}');

        showLoader();
        let res = await axios.post('/canidate-create-skil',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getskil();
            hideModal();
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

    async function confirmDelete(){
        var id = $('#confirmDelete').data('id');
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/canidate-delete-skil',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getskil();
            hideDelete();
        }else{
            errorToast(res.data['message']);
        }
    }
</script>
@endsection
