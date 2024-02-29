@extends('admin.layout.app')
@section('title','Jobs Control')
@section('content')

{{-- view modal --}}

<div class="modal fade show mt-5" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none; background-color: rgba(0, 0, 0, 0.5);"  aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Job Details</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label class="form-label" for="job_title">Job Title</label>
          <input class="form-control" type="text" id="job_title">

          <label class="form-label" for="description">Job Description</label>
          <textarea class="form-control" id="description" cols="30" rows="6"></textarea>

          <label class="form-label" for="skills">Job skills</label>
          <span class="form-text text-muted">php,laravel,javascript</span>
          <input class="form-control" type="text" id="skills">


          <label class="form-label" for="type">Category</label>
          <select class="form-control" id="category">

          </select>

          <label class="form-label" for="salary">Salary</label>
          <input class="form-control" type="text" id="salary">

          <label class="form-label" for="expire">Expire</label>
          <input class="form-control" type="date" id="expire">

          <div class="thumnail m-3">
            <img class="img-fluid" src="{{ asset('img/default.png')}}" id="thumnail">
          </div>


        </div>
      </div>
    </div>
</div>

{{-- view modal --}}

    <h1>Jobs Control</h1>
    <p>This is the jobs control page.</p>

    <div id="jobs">

    </div>

<script>




    // view jobs
    async function  viewjobs(id) {
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/user-view-jobs',postdata);
        hideLoader();
        let data = res.data['data'][0];
        $('#job_title').val(data['title']);
        $('#description').val(data['description']);
        $('#skills').val(data['skills']);
        $('#category').val(data['category_id']);
        $('#salary').val(data['salary']);
        $('#expire').val(data['expire']);
        $('#thumnail').attr('src','{{asset('')}}'+data['image']);
        $('#mymodal').modal('show');
    }





    getjobs();
    async function getjobs() {
        showLoader();
        let res = await axios.post('/user-total-jobs');
        hideLoader();
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html += `<div class="card p-3 mt-3">
            <div class="row">
                <div class="card-body col-md-8">
                    <h5 class="card-title">${element['title']}</h5>
                    <p class="card-text">${element['description']}</p>
                </div>
                <div class="col-md-4 text-end mt-3">
                    <button onclick="deleteModal(${element['id']})" class="btn btn-danger">Delete</button>
                    ${
                        (element['status'] == 0) ?
                        `<button onclick="publish(${element['id']})" class="btn btn-warning">Publish</button>` :
                        `<button class="btn btn-success disabled">Approve</button>`
                    }
                    <button onclick="viewjobs(${element['id']})" class="btn btn-primary">View</button>
                </div>
            </div>
        </div>`
        });
        $('#jobs').html(html);
    }


    async function  publish(id) {
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/publish-job',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getjobs();
        }else{
            errorToast(res.data['message']);
        }
    }


    getcategories();
    async function getcategories() {
        showLoader();
        let res = await axios.post('/get-categories');
        hideLoader();
        let data = res.data['categories'];
        let html = '';
        data.forEach(element => {
            html += '<option value="'+element['id']+'">'+element['title']+'</option>';
        });
        $('#category').html(html);
    }

    async function confirmDelete() {
        let id = $('#confirmDelete').data('id');
        showLoader();
        let postdata = new FormData();
        postdata.append('id',id);
        postdata.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/admin-delete-jobs',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            hideDelete();
            successToast(res.data['message']);
            await getjobs();
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
@endSection
