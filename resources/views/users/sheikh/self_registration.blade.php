@extends('users.sheikh.cover_register')
@section('content')
        <div class="row">
            
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                <div class="brand-logo align-items-center text-center">
                    <img src="{{ URL::to('/') }}/style/images/ifaida.png" alt="logo">
                </div>
                    
                    @if($errors->any())
                        <ul class="alert alert-danger" id="hide_msg">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif

                    @if(session('register_well'))
                      <li class="alert alert-primary text-center" id="regiser_well_hide_msg">
                        {{ session('register_well') }}
                      </li>
                      
                    @endif

                  <h4 class="text-center">Sheikh's registration form</h4>
                  
                    <form action="{{ route('sheikh_submit_form_data') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col">
                                <label>Firstname</label>
                                <input class="form-control" type="text" placeholder="Enter firstname" name="firstname" value="{{old('firstname')}}">
                            </div>
                            <div class="col">
                                <label>Lastname</label>
                                <input class="form-control" type="text" placeholder="Enter lastname" name="lastname" value="{{old('lastname')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Email</label>
                                <input class="form-control" type="text" placeholder="Enter email" name="email" value="{{old('email')}}">
                            </div>
                            <div class="col">
                                <label>Phone</label>
                                <input class="form-control" type="text" placeholder="Enter phone" name="phone" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            
                            </div>
                            <div class="col">
                                <label>Country</label>
                                <input class="form-control" type="text" placeholder="Enter country" name="country" value="{{old('country')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Title</label>
                                <input class="form-control" type="text" placeholder="Enter title" name="title" value="{{old('title')}}">
                            </div>
                            <div class="col">
                                <label>Faculty</label>
                                <input class="form-control" type="text" placeholder="Enter faculty" name="faculty" value="{{old('faculty')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Username</label>
                                <input class="form-control" type="text" placeholder="Enter username" name="username" value="{{old('username')}}">
                            </div>
                            <div class="col">
                                <label>Password</label>
                                <input class="form-control" type="password" placeholder="Enter password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Re_enter password</label>
                                <input class="form-control" type="password" placeholder="Re_enter password" name="password_confirmation">
                            </div>
                            <div class="col text-center mt-4">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        </div>            

        <script>
          setTimeout(() => {
            const message=document.getElementById('hide_msg');
            message.style.display="none";
          },10000);

          setTimeout(() => {
            const message=document.getElementById('regiser_well_hide_msg');
            message.style.display="none";
            window.location.href="{{ route('login.form') }}";   
          },5000);

          
        </script>

@endsection