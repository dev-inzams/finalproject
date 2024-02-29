@extends('admin.layout.app')
@section('title','Categories Control')
@section('content')

{{-- add categories --}}
<div class="modal fade show mt-5" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none; background-color: rgba(0, 0, 0, 0.5);"  aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Category</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="title">Title</label>
          <input class="form-control" type="text" id="title">

          <label class="form-label" for="description">Description</label>
          <textarea class="form-control" id="description" cols="30" rows="6"></textarea>

          <div class="thumnail m-3">
            <img class="img-fluid" src="{{ asset('img/default.png')}}" id="thumnail">
          </div>

          <label for="image">Image</label>
          <input oninput="thumnail.src = window.URL.createObjectURL(this.files[0])" class="form-control" type="file" id="image">

          <button onclick="addcategories()" class="btn btn-primary mt-3">Add Category</button>
        </div>
      </div>
    </div>
</div>
{{-- add categories --}}

<div class="modal fade show mt-5" id="mymodal123" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none; background-color: rgba(0, 0, 0, 0.5);"  aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Category</h1>
          <button type="button" class="btn-close" onclick="editModalhide()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="titleEdit">Title</label>
          <input class="form-control" type="text" id="titleEdit">

          <label class="form-label" for="descriptionEdit">Description</label>
          <textarea class="form-control" id="descriptionEdit" cols="30" rows="6"></textarea>

          <div class="thumnail m-3">
            <img class="img-fluid" src="{{ asset('img/default.png')}}" id="thumnailEdit">
          </div>

          <label for="image">Image</label>
          <input oninput="thumnailEdit.src = window.URL.createObjectURL(this.files[0])" class="form-control" type="file" id="imageEdit">

          <button id="editupdate" onclick="update()" class="btn btn-primary mt-3">Update</button>
        </div>
      </div>
    </div>
</div>

{{-- edit categories --}}

<div class="row">
    <div class="col-md-6">
      <h2>Categories Control</h2>
      <p>This is the categories control page.</p>
    </div>
    <div class="col-md-6 text-end">
        <button onclick="showModal()" type="button" class="btn btn-primary">Add Category</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="categories">

            </tbody>
        </table>
    </div>
</div>
<script>

    async function addcategories(){
        let title = $('#title').val();
        let description = $('#description').val();
        let image = $('#image').prop('files')[0];
        showLoader();
        let postdata = new FormData();
        postdata.append('title',title);
        postdata.append('description',description);
        postdata.append('image',image);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/create-category',postdata,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getCategories();
        }else{
            errorToast(res.data['message']);
        }
    }

    // get categories
    async function getCategories(){
        showLoader();
        let res = await axios.post('/get-categories');
        hideLoader();
        let data = res.data['categories'];
        let html = '';
        data.forEach(element => {
            html += '<tr>';
            html += '<td>'+element['id']+'</td>';
            html += '<td>'+element['title']+'</td>';
            html += '<td>'+element['description']+'</td>';
            html += '<td><img class="img-fluid thumnail rounded" src="{{asset('')}}'+element['image']+'" alt=""></td>';
            html += '<td><button class="btn btn-success d-block mb-2" onclick="edit('+element['id']+')">Edit</button><button class="btn btn-danger d-block" onclick="deleteModal('+element['id']+')">Delete</button></td>';
            html += '</tr>';
        });
        $('#categories').html(html);
    }
    getCategories();

// modal function
    function showModal(){
        $('#mymodal').modal('show');
    }

    function hideModal(){
        $('#mymodal').modal('hide');
    }

    // edit
    async function edit(id){

        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');
        showLoader();
        let res = await axios.post('/user-get-category',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            let data = res.data['category'];
            $('#titleEdit').val(data['title']);
            $('#descriptionEdit').val(data['description']);
            $('#thumnailEdit').attr('src','{{asset('')}}'+data['image']);
            $('#editupdate').attr('data-id', data['id']);
            $('#mymodal123').modal('show');
        }else{
            errorToast(res.data['message']);
        }
    }

    async function update(){
        let id = $('#editupdate').attr('data-id');
        let title = $('#titleEdit').val();
        let description = $('#descriptionEdit').val();
        let image = $('#imageEdit').prop('files')[0];
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('title',title);
        postdata.append('description',description);
        postdata.append('image',image);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/user-update-category',postdata,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            $('#mymodal123').modal('hide');
            await getCategories();
        }else{
            errorToast(res.data['message']);
        }
    }

    function editModal(){
        $('#mymodal123').modal('show');
    }
    function editModalhide(){
        $('#mymodal123').modal('hide');
    }
</script>
@endSection
