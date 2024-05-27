@extends('auth.cover')
@section('content')

        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-items-center">
                <img src="../style/images/logo.svg" alt="logo">
              </div>
              <h6 class="font-weight-light">Forgot password .</h6>
              <form class="pt-3">
                
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>

                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">Sent mail</a>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  <a href="{{ route('login.form')}}" class="text-primary">Back to login ?</a>
                </div>
              </form>
            </div>

@endsection