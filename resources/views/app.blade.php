<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ru"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Авторизация</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="{{ asset('public/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/metro.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style_responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/style_default.css') }}" rel="stylesheet" id="style_color" />
    <link href="{{ asset('public/assets/uniform/css/uniform.default.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/gritter/css/jquery.gritter.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/jqvmap/jqvmap/jqvmap.css') }}" />
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}" />
    <script src="{{ asset('public/js/script.js') }}"></script>
</head>


	@yield('content')
    <!-- BEGIN JAVASCRIPTS -->
    <script src="{{ asset('public/assets/js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('public/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/uniform/jquery.uniform.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.blockui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/jquery-validation/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            App.initLogin();
        });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
</html>
