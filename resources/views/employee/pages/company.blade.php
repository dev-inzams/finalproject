@extends('employee.layout.app')
@section('title','Company')
@section('content')
<h2>Welcome to your Company Dashboard</h2>
<div class="row">
    <div class="col-md-8" >
        <label for="company_name">Company Name</label>
        <input type="text" id="company_name" class="form-control">

        <label for="company_email"> Company Email</label>
        <input type="email" id="company_email" class="form-control">

        <label for="company_address">Company Address</label>
        <input type="text" id="company_address" class="form-control">

        <label for="company_phone">Company Phone</label>
        <input type="text" id="company_phone" class="form-control">

        <label for="company_website">Company Website</label>
        <input type="text" id="company_website" class="form-control">
    </div>
    <div class="col-md-4">
        <img id="new_logo" class="img-fluid rounded img-thumbnail" src="{{ asset('img/default.png') }}" alt="">
        <input oninput="new_logo.src = window.URL.createObjectURL(this.files[0])" type="file" id="company_logo" class="form-control">
    </div>
    <button onclick="updateCompany()" class="btn btn-primary btn-block w-25">Update</button>
</div>

<script>
    getCompany();
    async function getCompany(){
        showLoader();
        let res = await axios.post('/get-company');
        hideLoader();
        let data = res.data['data'][0];
        if(data == null){
            window.location.href = '/jobplus/create-company';
        }
            $('#company_name').val(data['Company_name']);
            $('#company_email').val(data['Company_email']);
            $('#company_address').val(data['Company_address']);
            $('#company_phone').val(data['Company_phone']);
            $('#company_website').val(data['Company_website']);
            $('#new_logo').attr('src', '{{ asset('') }}' + data['Company_logo']);
    }

    async function updateCompany(){
        var Company_name = $('#company_name').val();
        var Company_email = $('#company_email').val();
        var Company_address = $('#company_address').val();
        var Company_phone = $('#company_phone').val();
        var Company_website = $('#company_website').val();
        var Company_logo = $('#company_logo').prop('files')[0];
        showLoader();
        let postData = new FormData();
        postData.append('Company_name',Company_name);
        postData.append('Company_email',Company_email);
        postData.append('Company_address',Company_address);
        postData.append('Company_phone',Company_phone);
        postData.append('Company_website',Company_website);
        postData.append('Company_logo',Company_logo);
        postData.append('_token','{{ csrf_token() }}');
        let res = await axios.post('/user-update-company',postData,{
            headers:{
                'Content-Type':'multipart/form-data'
            }
        });
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getCompany();
        }else{
            errorToast(res.data['message']);
        }

    }


</script>
@endSection
