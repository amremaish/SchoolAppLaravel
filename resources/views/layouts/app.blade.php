<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta charset="utf-8">
    <title>School App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('assets/plugins/animate.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />
    <link href="/webarch/css/webarch.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen" />

   
</head>

<body class="pace-done">
    <div class="header navbar navbar-inverse ">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <div class="header-seperation">
                <ul class="nav pull-left notifcation-center visible-xs visible-sm">
                    <li class="dropdown">
                        <a href="#main-menu" data-webarch="toggle-left-side">
                            <i class="material-icons">menu</i>
                        </a>
                    </li>
                </ul>
                <!-- BEGIN LOGO -->

                <img src="/assets/img/logo.png" class="logo" alt="" data-src="/assets/img/logo.png" data-src-retina="/assets/img/logo2x.png" width="106" height="21">

                <!-- END LOGO -->
                <ul class="nav pull-right notifcation-center">
                    <li class="dropdown hidden-xs hidden-sm">
                        <a href="/profile" class="dropdown-toggle" data-toggle="">
                            <i class="material-icons">account_circle</i><span class=" bubble-only"></span>
                        </a>
                    </li>
                    <li class="dropdown visible-xs visible-sm">
                        <a href="/chat">
                            <i class="material-icons">chat</i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <div class="header-quick-nav" style="background-color:#1b1e24;">
                <div class="pull-right">
                    <ul class="nav quick-section ">
                        <li class="quicklinks">
                            <a href="/chat">
                            <i class="material-icons " style ="color : white;">chat</i>
                            <span id = "notifi_counter" class="badge badge-important hide">1</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="pull-right" >
                    <img src = "/img/shcool_logo.png" style ="margin-top:4px" width="50" height="50" >
                </div>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar " id="main-menu">
            <!-- BEGIN MINI-PROFILE -->
            <div class="scroll-wrapper page-sidebar-wrapper scrollbar-dynamic" style="position: relative;">
                <div class="page-sidebar-wrapper scrollbar-dynamic scroll-content" id="main-menu-wrapper" style="margin-bottom: -17px; margin-right: -17px;">
                    <div class="user-info-wrapper sm">
                        <div class="profile-wrapper sm">
                            <img src="{{Session::get('cur_user')["imagePath"]}}" data-src="{{Session::get('cur_user')["imagePath"]}}" data-src-retina="{{Session::get('cur_user')["imagePath"]}}" width="69" height="69">
                            <div class="availability-bubble online"></div>
                        </div>
                        <div class="user-info sm">
                            <div class="username" style="margin-top:10px">{{Session::get('cur_user')["username"]}}</div>
                            <div class="status"> &nbsp;</div>
                        </div>
                    </div>
                    <!-- END MINI-PROFILE -->
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul>
                        <li>
                            <a href="/material"> <i class="material-icons">apps</i> <span class="title">Materials</span> </a>
                        </li>
                        <li>
                            <a href="/exams"> <i class="material-icons">offline_bolt</i> <span class="title">Exams</span> </a>
                        </li>
                    @if(Session::get('cur_user')["userType"] == "admin")
                        <li>
                            <a href="/mat_requests"> <i class="material-icons">find_in_page</i> <span class="title">Materials request</span> </a>
                        </li>
                    @endif
                        <li>
                            <a href="/logout"> <i class="material-icons">power_settings_new</i> <span class="title">Log out</span> </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <!-- END SIDEBAR MENU -->
                </div>
                <div class="scroll-element scroll-x">
                    <div class="scroll-element_outer">
                        <div class="scroll-element_size"></div>
                        <div class="scroll-element_track"></div>
                        <div class="scroll-bar" style="width: 96px;">
                        </div>
                    </div>
                </div>
                <div class="scroll-element scroll-y">
                    <div class="scroll-element_outer">
                        <div class="scroll-element_size">
                        </div>
                        <div class="scroll-element_track">
                        </div>
                        <div class="scroll-bar" style="height: 96px; top: 0px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="clearfix"></div>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="modal fade" id = "loading_modal" tabindex="-1" role="dialog">
        <div style="margin-left : 50% ; margin-top :30%" class="modal-dialog modal-dialog-centered justify-content-center" role="document">
            <span style = " color: white;"class="fa fa-spinner fa-spin fa-7x"></span>
        </div>
    </div>

    <div id="cur_email" style="display: none;">{{Session::get('cur_user')["email"]}}</div>
    <script src="{{asset('assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN JS DEPENDECENCIES-->
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
    <script src="{{asset('/js/nav.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/exams.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/material.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/exam_details.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/material_requests.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/profile.js')}}" type="text/javascript"></script>
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
       <script src="{{asset('/js/app.js')}}" type="text/javascript"></script>
</body>



</html>