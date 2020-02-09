<html>
        <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta charset="utf-8">
        <title>School App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- BEGIN PLUGIN CSS -->
        <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset('assets/plugins/jquery-ricksaw-chart/css/rickshaw.css') }}" type="text/css" media="screen">
        <!-- END PLUGIN CSS -->
        <!-- BEGIN PLUGIN CSS -->

        <link href="{{asset('assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet"type="text/css"/>
        <link href="assets/plugins/woff2.css" rel="stylesheet">
        <link href="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PLUGIN CSS -->
        <!-- BEGIN CORE CSS FRAMEWORK -->
        <link href="{{asset('webarch/css/webarch.css') }}" rel="stylesheet" type="text/css"/>

        <!-- END PLUGIN CSS -->
        <!-- BEGIN CORE CSS FRAMEWORK -->
        <link href="webarch/css/webarch.css" rel="stylesheet" type="text/css">
        <!-- END CORE CSS FRAMEWORK -->   
        <link href="{{asset('scss/radio.scss') }}" rel="stylesheet" type="text/css"/>
      </head>

         @yield('content')
          
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
        <script src="{{asset('js/login.js') }}" type="text/javascript"></script>
</html>