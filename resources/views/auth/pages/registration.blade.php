@extends('auth.layout.app')
@section('title','Registration')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 login-container">
        <div class="card">
          <div class="card-header">
            <h4>Register</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
                <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" value="employee" autocomplete="off">
                <label class="btn btn-outline-success" for="success-outlined">Employee</label>

                <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" value="canidate" autocomplete="off">
                <label class="btn btn-outline-primary" for="danger-outlined">Canidate</label>
            </div>

              <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" required>
              </div>
              <button onclick="register()" type="submit" class="btn btn-primary btn-block btn-login">Register</button>
            <a href="{{ url('/login') }}" class="btn btn-link">Login</a>
          </div>



        </div>
      </div>
    </div>
  </div>

  <script>
    async function register(){
        var type = $('input[name="options-outlined"]:checked').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm-password').val();
        if(password != confirm_password){
            errorToast('Password and Confirm Password does not match');
        }else{
            let postdata = new FormData();
            postdata.append('email',email);
            postdata.append('password',password);
            postdata.append('type',type);
            postdata.append('_token','{{ csrf_token() }}');
            showLoader();
            let res = await axios.post('/user-registration',postdata);
            hideLoader();
            if(res.data['status'] == 'success'){
                successToast(res.data['message']);
                if(res.data['type'] == 'admin'){
                    window.location.href = '/jobplus/admin';
                }else if(res.data['type'] == 'employee'){
                    window.location.href = '/jobplus/employee';
                }else{
                    window.location.href = '/jobplus/candidate';
                }
            }else{
                errorToast(res.data['message']);
            }
        }
    }
  </script>
  @endSection
