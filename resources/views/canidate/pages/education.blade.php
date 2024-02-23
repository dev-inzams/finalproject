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
          <label class="form-label" for="job_title">Job Title</label>
          <input class="form-control" type="text" id="job_title">

          <label class="form-label" for="description">Job Description</label>
          <textarea class="form-control" id="description" cols="30" rows="6"></textarea>

          <label class="form-label" for="skills">Job skills</label>
          <span class="form-text text-muted">php,laravel,javascript</span>
          <input class="form-control" type="text" id="skills">

          <label class="form-label" for="category">Category</label>
          <select class="form-control" id="category"></select>



          <label class="form-label" for="expire">Expire</label>
          <input class="form-control" type="date" id="expire">

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
            <button type="button" class="btn btn-primary">Add Education</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Degree</th>
                <th scope="col">Institute</th>
                <th scope="col">Passing Year</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Bachelor of Computer Science</td>
                <td>University of Dhaka</td>
                <td>2020</td>
            </tr>
        </tbody>
    </table>
</div>


@endsection
