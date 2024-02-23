@extends('auth.layout.app')
@section('title','Login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 login-container">
        <div class="card">
          <div class="card-header">
            <h4>Login</h4>
          </div>
          <div class="card-body">

              <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
              </div>
              <button onclick="login()" type="submit" class="btn btn-primary btn-block btn-login">Login</button>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    async function login(){

      var email = $('#email').val();
      var password = $('#password').val();
      showLoader();
      let postData = new FormData();
      postData.append('email',email);
      postData.append('password',password);
      postData.append('_token','{{ csrf_token() }}');

      let res = await axios.post('/user-login',postData);
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

    } // end of login
  </script>
@endSection
