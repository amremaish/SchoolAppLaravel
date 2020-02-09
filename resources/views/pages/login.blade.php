@extends('layouts.base_login') @section('content')
<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
<body class="error-body no-top lazy  pace-done" data-original="/assets/img/background.jpg" style="background-image: url('/assets/img/background.jpg') ; ">
 
  <div class="container">
            <div class="row login-container animated fadeInUp">
              <div class="col-md-8 col-md-offset-2 tiles white no-padding">
                <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10">
                  <h2 class="normal"> Sign in to School </h2>
                  <p class="p-b-20"> Sign up Now! for School accounts, it's free and always will be.. </p>
                  <div role="tablist">
                    <a id="tab_btn_login" class="btn btn-primary btn-cons" >Login</a> or&nbsp;&nbsp;
                    <a id="tab_btn_register" class="btn btn-info btn-cons" >Create an account</a>
                  </div>
                </div>
                <div class="tiles grey p-t-20 p-b-20 no-margin text-black tab-content">
                  <div role="tabpanel" class="tab-pane active" id="tab_login">
                    <form class="animated fadeIn validate" method="POST" action = "/login" novalidate="novalidate">
                        @csrf
                      <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                        <div class="col-md-6 col-sm-6">
                          <input class="form-control" id="login_email" name="login_email" placeholder="Email" type="email" required="" aria-required="true">
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <input class="form-control" id="login_pass" name="login_pass" placeholder="Password" type="password" required="" aria-required="true">
                        </div>
                      </div>
                     <br>
                      <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                          <div class="col-md-6">
                              <button class="btn btn-info btn-cons" >Submit</button>
                          </div>  
                    </form>     
                        @if ($correct == 'not_hide')
                          <div class="col-md-6">
                              <p class="p-b-20 text-danger"> Email or password isn't correct. </p>
                          </div>   
                        @endif
                    </div>
                </div>
                  <div role="tabpanel" class="tab-pane" id="tab_register">
                    {{-- <form class="animated fadeIn validate" method="POST" action = "/signup" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf --}}
                      <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                        <div class="col-md-4 col-sm-4">
                          <input class="form-control" id="reg_username" name="reg_username" placeholder="Username" type="text" required>
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <input class="form-control" id="reg_email" name="reg_email" placeholder="Email" type="text" required>
                        </div>
                      </div>
                      <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                        <div class="col-md-6 col-sm-6">
                          <input class="form-control" id="reg_pass" name="reg_pass" placeholder="Password" type="password" required>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" id="reg_con_pass" name="reg_con_pass" placeholder="Confirm password" type="password" required="">
                          </div>
                      </div>
                      <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                        <div class="col-md-6 col-sm-6">
                          <input class="form-control" id="reg_age" name="reg_age" placeholder="Age" type="text" required="">
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <input class="form-control" id="reg_phone_num" name="reg_phone_num" placeholder="Phone number" type="text" required="">
                        </div>
                      </div> 
                      <div class=" row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10 " >
                          <div class="radio radio-success">
                            <div class="col-md-4">
                              <input type="radio" id="student_radio" name="type_radio" checked class="custom-control-input">
                              <label class="custom-control-label " for="student_radio">Are you Student ?</label>
                            </div>
                            <div class="col-md-4 ">
                              <input type="radio" id="teacher_radio" name="type_radio" class="custom-control-input">
                              <label class="custom-control-label" for="teacher_radio">Are you Teacher ?</label>
                            </div>
                            <div class="col-md-4 ">
                              <input type="radio" id="parent_radio" name="type_radio" class="custom-control-input">
                              <label class="custom-control-label " for="parent_radio">Are you Parent ?</label>
                          </div>
                          </div>
                          <br>
                          <br>
                          <div class="col-md-6 col-sm-6">
                              <label for="file">Choose profile image to upload</label>
                              <input name ="profImg" id ="profImg" type="file" accept="image/*">
                          </div>          
                    </div>
                    <br>
                    <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                      <div class="col-md-6">
                          <button id="submit_btn_register" onclick="upload()" class="btn btn-info btn-cons">Submit</button>
                      </div>
                      <div class="col-md-6 ">
                        <p class="p-b-20 text-danger bold hide " id ="error_reg">* Email or password isn't correct. </p>
                    </div>   
                  </div>
                </div>
              {{-- </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>

   <div class="modal fade" id = "loading_modal" tabindex="-1" role="dialog">
  </div>
  
</body>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="{{asset('assets/plugins/bootstrapv3/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-block-ui/jqueryblockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-select2/select2.min.js')}}" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-notifications/js/messenger-theme-future.js" type="text/javascript"></script>
    <script src="/webarch/js/webarch.js" type="text/javascript"></script>
    <script src="{{asset('js/sign_up.js')}}" type="text/javascript"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
    <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBP-ipdROC_e2JRHMiZZqA8qil69Jt0I1k",
        authDomain: "schoolapp-dbb96.firebaseapp.com",
        databaseURL: "https://schoolapp-dbb96.firebaseio.com",
        projectId: "schoolapp-dbb96",
        storageBucket: "schoolapp-dbb96.appspot.com",
        messagingSenderId: "539460020831",
        appId: "1:539460020831:web:f1c8f2113c1a7c3da349ea"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
  </script>



@endsection