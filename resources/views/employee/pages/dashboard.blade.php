@extends('employee.layout.app')
@section('title','User Dashboard')
@section('content')

<div class="row">
    <div class="col-md-12">
      <h2>Welcome to your Dashboard</h2>
      <p>This is a simple user dashboard with left side menu and top bar menu.</p>
    </div>
</div>
{{-- make 4 cards --}}
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong id="total_jobs"></strong></h5>
                <p class="card-text"><a class="p" href="{{ route('jobs') }}">Total Jobs</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong id="total_apply">10</strong></h5>
                <p class="card-text">Total Apply</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong id="selected_canidate">10</strong></h5>
                <p class="card-text">Selected Canidate</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">10</h5>
                <p class="card-text">Total Employees</p>
            </div>
        </div>
    </div>

</div>
<script>
    getdashboard();
    async function getdashboard() {
        showLoader();
        let res = await axios.post('/employee-all-details');
        hideLoader();
        let data = res.data;
        if(data['status'] == 'success'){
            $('#total_jobs').html(data['total_jobs']);
        }
    }
</script>
@endSection
