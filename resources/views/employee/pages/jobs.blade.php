@extends('employee.layout.app')
@section('title', 'Jobs')
@section('content')

{{-- add jobs --}}
<div class="modal fade show mt-5" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none; background-color: rgba(0, 0, 0, 0.5);"  aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">Add Jobs</h1>
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

          <label class="form-label" for="category">Category</label>
          <select class="form-control" id="category"></select>

          <label class="form-label" for="type">Job Type</label>
          <select class="form-control" id="type">
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
            <option value="internship">Internship</option>
            <option value="Hourly">Hourly</option>
          </select>

          <label class="form-label" for="salary">Salary</label>
          <input class="form-control" type="text" id="salary">

          <label class="form-label" for="expire">Expire</label>
          <input class="form-control" type="date" id="expire">

          <div class="thumnail m-3">
            <img class="img-fluid" src="{{ asset('img/default.png')}}" id="thumnail">
          </div>

          <label for="image">Job Image</label>
          <input oninput="thumnail.src = window.URL.createObjectURL(this.files[0])" class="form-control" type="file" id="image">

          <button onclick="addJobs()" class="btn btn-primary mt-3">Add Jobs</button>
        </div>
      </div>
    </div>
</div>
{{-- add jobs --}}
<div class="modal fade show mt-5" id="mymodal2" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none; background-color: rgba(0, 0, 0, 0.5);" aria-modal="true" role="dialog">
    <div class="container">
        <div class="modal-dialog modal-lg">
          <div class="modal-content border-normal">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLgLabel">View Applicants</h1>
              <button type="button" class="btn-close" onclick="hideApplicates()" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="applicants">

                </div>
            </div>
          </div>
        </div>
    </div>
</div>


{{-- modal --}}
<div class="row">
    <div class="col-md-8">
        <h2>All Jobs</h2>
    </div>
    <div class="col-md-4 text-end">
        <button onclick="showModal()" class="btn btn-primary">Add Job</button>
    </div>
</div>

    <div id="jobs" class="row mt-3"></div>




<script>
    getCategories();
    async function getCategories(){
       let res = await axios.post('/get-jobs-category')
       let data = res.data['data'];
       data.forEach(element => {
           $('#category').append('<option value="'+element['id']+'">'+element['title']+'</option>')
       });
    }

    getJobs();
    async function getJobs() {
        showLoader();
        let res = await axios.post('/user-get-jobs');
        hideLoader();
        let data = res.data['data'];
        let html = '';
        data.forEach(element => {
            html +=
            '<div class="card mb-3">' +
                '<div class="card-body">' +
                    '<div class="row">' +
                        '<div class="col-md-6">' +
                            '<h5 class="card-title">' + element['title'] + '</h5>' +
                            '<p class="card-text">' + element['description'] + '</p>' +
                            '<ul class="list-group list-group-flush">' +
                                '<li class="list-group-item">' + element['skills'] +'</li>' +
                                '<li class="list-group-item">' + element['type'] + '</li>' +
                                '<li class="list-group-item">' + element['salary'] + '</li>' +
                            '</ul>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                            '<img class="img-fluid w-75 h-75" src="{{ asset('') }}' + element['image'] + '" alt="' + element['title'] + '">' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<button onclick="deleteJobs(' + element['id'] + ')" class="btn btn-danger btn-block">Delete</button>' +
                            '<button onclick="getApplicants(' + element['id'] + ')" class="btn btn-primary btn-block mt-3">View Applicants</button>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
            $('#jobs').html(html);
        });
    }


    async function addJobs() {
        var job_title = $('#job_title').val();
        var description = $('#description').val();
        var skills = $('#skills').val();
        var category = $('#category').val();
        var type = $('#type').val();
        var salary = $('#salary').val();
        var expire = $('#expire').val();
        var image = $('#image').prop('files')[0];

        let postData = new FormData();
        postData.append('title',job_title);
        postData.append('description',description);
        postData.append('skills',skills);
        postData.append('category_id',category);
        postData.append('type',type);
        postData.append('salary',salary);
        postData.append('expire',expire);
        postData.append('image',image);
        postData.append('_token','{{ csrf_token() }}');

        showLoader();
        let res = await axios.post('/create-jobs',postData,{
            headers:{
                'Content-Type':'multipart/form-data'
            }
        });
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            hideModal();
            await getJobs();
        }else{
            errorToast(res.data['message']);
        }
    }

    // delete
    async function deleteJobs(id) {
        showLoader();
        let res = await axios.post('/destroy-jobs',{
            id:id
        });
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getJobs();
        }
    }

    async function getApplicants(id) {
        showLoader();
        viewApplicants();
        let res = await axios.post('/view-job-applicants',{
            job_id:id
        });
        hideLoader();
        let data = res.data['data'];
        if(data.length == 0){
            $('#applicants').html('No Applicants Found');
            return;
        }
        let html = '';
        data.forEach(element => {
            html += '<div class="card mb-3">' +
                '<div class="card-body">' +
                    '<div class="row">' +
                        '<div class="col-md-4">' +
                            '<img class="img-fluid img-thumbnail thumnail" src="{{ asset('') }}' + element['image'] + '" alt="' + element['name'] + '">' +
                        '</div>' +

                        '<div class="col-md-5">' +
                            '<h5 class="card-title">' + element['name'] + '</h5>' +
                            '<p class="card-text">' + element['portfolio_link'] + '</p>' +
                            '<p class="card-text">' + element['github'] + '</p>' +
                        '</div>' +

                        '<div class="col-md-3">' +
                            '<a href="{{asset('')}}canidate-profile/' + element['id'] + '" class="btn btn-success btn-block">View Profile</a>' +
                            '<button onclick="selected(' + id + ',' + element['id'] + ')" class="btn btn-primary btn-block mt-3 ' + (element['status'] == 'selected' ? 'disabled' : '') + '">Selected</button>' +

                        '</div>' +

                    '</div>' +
                '</div>' +
            '</div>';
        });
        document.getElementById('applicants').innerHTML = html;
    }

    async function selected(job_id, candidate_id) {
        let postdata = new FormData();
        postdata.append('job_id',job_id);
        postdata.append('candidate_id',candidate_id);
        postdata.append('_token','{{ csrf_token() }}');
        showLoader();
        let res = await axios.post('/selected-canidate',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
        }
    }


// modal
    function hideModal(){
        document.getElementById('mymodal').style.display = 'none';
    }

    function showModal(){
        document.getElementById('mymodal').style.display = 'block';
    }
    function viewApplicants(){
        document.getElementById('mymodal2').style.display = 'block';
    }
    function hideApplicates(){
        document.getElementById('mymodal2').style.display = 'none';
    }

</script>
@endsection
