@extends('admin.layout.app')
@section('title','Posts Control')
@section('content')

{{-- add posts --}}
<div class="modal fade show mt-5" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none; background-color: rgba(0, 0, 0, 0.5);"  aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Job Details</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="title">Title</label>
          <input class="form-control" type="text" id="title">

          <label class="form-label" for="short_des">Short Description</label>
          <textarea class="form-control" id="short_des" cols="30" rows="6"></textarea>

          <label class="form-label" for="description">Description</label>
          <textarea class="form-control" id="description" cols="30" rows="6"></textarea>


          <label class="form-label" for="type">Category</label>
          <select class="form-control" id="category">

          </select>

          <div class="thumnail m-3">
            <img class="img-fluid" src="{{ asset('img/default.png')}}" id="thumnail">
          </div>
          <input oninput="thumnail.src = window.URL.createObjectURL(this.files[0])" class="form-control" type="file" id="image">
          <button onclick="addPost()" class="btn btn-primary mt-3">Add Post</button>

        </div>
      </div>
    </div>
</div>

{{-- add posts --}}

<div class="row">
    <div class="col-md-8">
        <h1>Posts Control</h1>
        <p>This is the posts control page.</p>
    </div>
    <div class="col-md-4 text-end">
        <button onclick="showModal()" type="button" class="btn btn-primary">Add Post</button>
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
            <tbody id="posts">

            </tbody>
        </table>
    </div>
</div>

<script>
    getposts();
    async function getposts(){
        showLoader();
        let res = await axios.post('/user-get-blogs');
        hideLoader();
        let data = res.data['data'];
        let html = '';
        for(let i=0;i<data.length;i++){
            html += '<tr class="mb-2">';
            html += '<td>'+data[i].id+'</td>';
            html += '<td>'+data[i].title+'</td>';
            html += '<td>'+data[i].description+'</td>';
            html += '<td><img src="{{asset('')}}'+data[i].image+'" width="100" height="100"></td>';
            html += '<td><button class="btn btn-success mb-2" onclick="edit('+data[i].id+')">Edit</button><button class="btn btn-danger" onclick="deleteModal('+data[i].id+')">Delete</button></td>';
            html += '</tr>';
        }
        $('#posts').html(html);
    }

    async function  addPost() {
        let title = $('#title').val();
        let short_des = $('#short_des').val();
        let description = $('#description').val();
        let category = $('#category').val();
        let image = $('#image').prop('files')[0];

        let formData = new FormData();
        formData.append('title',title);
        formData.append('short_des',short_des);
        formData.append('description',description);
        formData.append('category_id',category);
        formData.append('image',image);
        formData.append('_token','{{ csrf_token() }}');
        showLoader();
        let res = await axios.post('/user-create-blog',formData,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        hideLoader();
        if(res.data['success']){
            successToast(res.data['message']);
            hideModal();
            await getposts();
        }
    }

    getpostCategories();
    async function getpostCategories(){
        let res = await axios.post('/get-categories');
        let data = res.data['categories'];
        let html = '';
        data.forEach(element => {
            html += '<option value="'+element['id']+'">'+element['title']+'</option>';
        })
        $('#category').html(html);
    }

    function showModal(){
        $('#mymodal').modal('show');
    }

    function hideModal(){
        $('#mymodal').modal('hide');
    }

    async function confirmDelete(){
        var id = $('#confirmDelete').data('id');
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');

        let res = await axios.post('/user-delete-blog',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getposts();
            hideDelete();
        }else{
            errorToast(res.data['message']);
        }
    }
</script>
@endSection
