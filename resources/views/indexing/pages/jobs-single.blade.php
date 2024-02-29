@extends('indexing.layout.app')
@section('title', 'Jobs - JobPulse')
@section('content')
{{-- add jobs --}}
<div class="modal fade show" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-normal">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="exampleModalLgLabel">{{ $job['title'] }}</h1>
          <button type="button" class="btn-close" onclick="hideModal()" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <label class="form-label" for="description">Description</label>
          <textarea class="form-control" id="description"></textarea>

          <label class="form-label" for="price">Expected Salary</label>
          <input class="form-control" type="text" id="price">




          <button onclick="apply()" class="btn btn-primary mt-3">Apply</button>
        </div>
      </div>
    </div>
</div>
{{-- add jobs --}}

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset($job['image']) }}" class="img-fluid img-thumbnail" alt="...">
            </div>

            {{-- col-md-4 --}}

            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5">{{ $job['title'] }}</h5>
                        <p class="card-text"> <strong>Skills:</strong> {{ $job['skills'] }}</p>
                        <p class="card-text"> <strong>Type:</strong> {{ $job['type'] }}</p>
                        <p class="card-text"> <strong>Salary:</strong> {{ $job['salary'] }}</p>
                        <p class="card-text"> <strong>Expire:</strong> {{ $job['expire'] }}</p>
                        <p class="card-text"> <strong>Category:</strong> {{ $category['title'] }}</p>
                        <p class="card-text"> <strong>Company:</strong> {{ $company['Company_name'] }}</p>
                        <button onclick="showModal()" class="btn btn-primary">Apply Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <h3 class="text-light text-center">Job Description</h3>
            <div class="col-md-12">
                <p class="bg-light p-2">{{ $job['description'] }}</p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        @include('indexing.components.job-card')
    </div>


<script>

    async function apply(){
        let description = document.getElementById('description').value;
        let price = document.getElementById('price').value;
        showLoader();
        let postdata = new FormData();
        postdata.append('description',description);
        postdata.append('price',price);
        postdata.append('_token','{{ csrf_token() }}');
        postdata.append('job_id','{{ $job['id'] }}');
        postdata.append('company_id','{{ $company['id'] }}');

        let res = await axios.post('/apply-for-job',postdata);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            hideModal();
            window.location.reload();
        }
        else{
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
