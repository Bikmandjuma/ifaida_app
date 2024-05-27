@extends('auth.cover')
@section('content')

        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-items-center">
                <img src="../style/images/logo.svg" alt="logo">
              </div>
              <h6 class="font-weight-light">Sign in to continue.</h6>
      
               @if ($errors->any())
                    <!-- <div > -->
                        <ul class="alert alert-danger" id="disable_message">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    <!-- </div> -->
                @endif

                @if (session('error-message'))
                    <!-- <div> -->
                        <ul class="alert alert-danger" id="disable_message">
                            <li>{{ session('error-message') }}</li>
                        </ul>
                    <!-- </div> -->
                @endif

                @if (session('well_login'))
                    <div>
                        <ul class="alert alert-success" id="disable_message">
                            <li>{{ session('well_login') }}</li>
                        </ul>
                    </div>
                @endif
       
                <form class="pt-3" action="{{route('login-functionality')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{old('email')}}">
                  
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Enter password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  <a href="{{route('ForgotPasswordForm')}}" class="text-primary">Forgot password ?</a>
                </div>
              </form>
        </div>

        <script>
          setTimeout(() => {
            const message=document.getElementById('disable_message');
            message.style.display="none";
          },5000);
        </script>

@endsection