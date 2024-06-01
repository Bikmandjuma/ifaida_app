@extends('users.admin.cover')
@section('content')
        
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
              <!-- <div> -->
                
              <!-- </div> -->
              <div class="card">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li class="alert alert-danger text-center" id="disable_msg">{{ $error }}</li>
                            @endforeach
                        @endif

                        @if(session('done_status_msg'))
                          <li class="alert alert-danger text-center" id="disable_msg">{{ session('done_status_msg') }}</li>
                        @endif

                        @if(session('null_status_msg'))
                          <li class="alert alert-danger text-center" id="disable_msg">{{ session('null_status_msg') }}</li>
                        @endif

                        @if(session('mail_sent'))
                          <li class="alert alert-info text-center" id="disable_msg">{{ session('mail_sent') }}</li>
                        @endif

                    </div>
                    <div class="col-lg-4"></div>
                  </div>

                  <h4 class="card-title">Sheikh</h4>
                  <button class="btn btn-primary float-right" style="margin-top:-50px;" data-toggle="modal" data-target="#ModalAddSheikh" id="send_email_to_sheikh_id"><i class="ti-user"></i> Add new by email</button>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            User
                          </th>
                          <th>
                            First name
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Deadline
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="../style/images/faces/face1.jpg" alt="image"/>
                          </td>
                          <td>
                            Herman Beck
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="../style/images/faces/face2.jpg" alt="image"/>
                          </td>
                          <td>
                            Messsy Adam
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td>
                            July 1, 2015
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

        <!--start of Logout modal -->
        <div class="modal" id="ModalAddSheikh" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-md text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size:-20px;"><span aria-hidden="true">×</span></button>
                  <h4>Enter Sheikh's email&nbsp;<i class="mdi mdi-email" id="logout_sys_icon"></i></h4>
                </div>
                <div class="modal-body" style="margin-top:-50px;">
                  <div class="actionsBtns">
                    <form action="{{ route('send_email_to_sheikh') }}" method="POST">
                      @csrf
                       <input type="email" name="email" class="form-control" placeholder="Enter email . . . " Required/>
                       <button type="submit" class="btn btn-primary mt-2">Send&nbsp;<i class="ti-send" style="margin-top:10px;"></i></button>
                    </form>
                      <!-- <button class="btn btn-danger float-right" data-dismiss="modal"><i class="fa fa-times"></i> Not now</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--end of logout modal-->
        
        <script>
          setTimeout(()  => {
              var error=document.getElementById('disable_msg');
              error.style.display="none";
              // open_btn();
          },5000);
        </script>

@endsection