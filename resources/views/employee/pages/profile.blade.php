@extends('employee.layout.app')
@section('title','Profile')
@section('content')

<h2>Welcome to your Profile</h2>
<div class="row">
    <div class="col-md-8" >
        <label for="employee_name">Name</label>
        <input type="text" id="employee_name" class="form-control">

        <label for="emali"> Email</label>
        <input readonly type="email" id="email" class="form-control">

        <label for="employee_phone"> Phone</label>
        <input type="text" id="employee_phone" class="form-control">

        <label for="employee_address"> Address</label>
        <input type="text" id="employee_address" class="form-control">

        <button onclick="updateProfile()" class="btn btn-primary btn-block mt-3">Update</button>
    </div>
    <div class="col-md-4">
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" class="form-control">

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" class="form-control">

        <button onclick="changePassword()" class="btn btn-danger btn-block mt-3">Change Password</button>
    </div>

</div>

<script>
    getuser();
    async function getuser(){
        showLoader();
        let res = await axios.post('/employer-get-profile');
        hideLoader();
        if(res.data['status']== 'success'){
            let user = res.data['user'];
            let employee = res.data['employee'];

            $('#employee_name').val(employee['employee_name']);
            $('#email').val(user['email']);
            $('#employee_phone').val(employee['employee_phone']);
            $('#employee_address').val(employee['employee_address']);
        }
    }

    async function updateProfile(){
        var employee_name = $('#employee_name').val();
        var employee_phone = $('#employee_phone').val();
        var employee_address = $('#employee_address').val();
        var email = $('#email').val();

        let postData = new FormData();
        postData.append('employee_name',employee_name);
        postData.append('employee_phone',employee_phone);
        postData.append('employee_address',employee_address);
        postData.append('email',email);

        showLoader();
        let res = await axios.post('/employer-update-profile',postData);
        hideLoader();
        if(res.data['status'] == 'success'){
            successToast(res.data['message']);
            await getuser();
        }else{
            errorToast(res.data['message']);
        }
    }

    async function changePassword(){
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        if(new_password != confirm_password){
            errorToast('New Password and Confirm Password does not match');
        }else{
            showLoader();
            let res = await axios.post('/user-reset-password',{
                'password':new_password
            });
            hideLoader();
            if(res.data['status'] == 'success'){
                successToast(res.data['message']);
                await getuser();
            }else{
                errorToast(res.data['message']);
            }
        }
    }
</script>
@endSection
