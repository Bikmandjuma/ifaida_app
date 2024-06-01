@extends('auth.cover')
@section('content')

  <!-- use Illuminate\Support\Facades\Crypt;
  use Illuminate\Support\Facades\Request;

  $email=request::get('email');
  $Decrypted_email=Crypt::decrypt($email); -->
  
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-items-center">
                <img src="{{ URL::to('/') }}/style/images/ifaida.png" alt="logo">
              </div>
              @if($errors->any())
                  <ul class="alert alert-danger text-center" id="disable_message">
                    
                    @foreach($errors->all() as $error)
                        <li style="list-style-type:none;">{{ $error }}</li>  
                    @endforeach
                    
                  </ul>
              @endif
              
              @if(session('email_msg_status'))
  
                <ul class="alert alert-success text-center" id="mail_found">
                  <li style="list-style-type:none;">{{ session('email_msg_status') }}</li>
                </ul>

              @endif

              @if(session('email_msg_already_used'))
  
                <ul class="alert alert-primary text-center" id="disable_message">
                  <li style="list-style-type:none;">This email <b>{{ session('email_msg_already_used') }}</b> already registered !</li>
                </ul>

              @endif

              <h6 class="font-weight-light">Check your email before registration</h6>
              
              <form class="pt-3" method="POST" action="{{ route('Sheikh.Verify.Email.Before.Registration') }}">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="InputEmail1" name="email" placeholder="Enter email" value="{{ $got_email }}">
                </div>

                <div class="mt-3 text-center">
                    <button class="btn btn-primary" type="submit">Verify</button>
                  <!-- <a type class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">Verify</a> -->
                </div>
            
              </form>
            </div>

        <script>
          setTimeout(() => {
            const message=document.getElementById('disable_message');
            message.style.display="none";
          },5000);

          //mail found
          setTimeout(() => {
            const message=document.getElementById('mail_found');
            message.style.display="none";
            window.location.href='{{ route("Sheikh_self_registration_form") }}';
          },5000);
        </script>

@endsection