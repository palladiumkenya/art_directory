<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets1/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ URL::asset('assets1/img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ URL::asset('assets1/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ URL::asset('assets1/css/material-dashboard.css?v=2.0.2') }}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ URL::asset('assets1/css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
@include('layouts.partials.nav')
{{--{!! app('captcha')->renderJs() !!}--}}
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" filter-color="black" style="background: #dddddd;">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        @yield('content')
        @include('layouts.partials.footer')
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{ URL::asset('assets1/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets1/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets1/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets1/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets1/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ URL::asset('assets1/js/jquery.validate.min.js') }}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ URL::asset('assets1/js/moment.min.js') }}"></script>
<!--  Charts Plugin -->
<script src="{{ URL::asset('assets1/js/chartist.min.js') }}"></script>
<!--  Plugin for the Wizard -->
<script src="{{ URL::asset('assets1/js/jquery.bootstrap-wizard.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ URL::asset('assets1/js/bootstrap-notify.js') }}"></script>
<!-- DateTimePicker Plugin -->
<script src="{{ URL::asset('assets1/js/bootstrap-datetimepicker.js') }}"></script>
<!-- Vector Map plugin -->
<script src="{{ URL::asset('assets1/js/jquery-jvectormap.js') }}"></script>
<!-- Sliders Plugin -->
<script src="{{ URL::asset('assets1/js/nouislider.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Select Plugin -->
<script src="{{ URL::asset('assets1/js/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{ URL::asset('assets1/js/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{ URL::asset('assets1/js/sweetalert2.js') }}"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ URL::asset('assets1/js/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{ URL::asset('assets1/js/fullcalendar.min.js') }}"></script>
<!-- TagsInput Plugin -->
<script src="{{ URL::asset('assets1/js/jquery.tagsinput.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ URL::asset('assets1/js/material-dashboard.js') }}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ URL::asset('assets1/js/demo.js') }}"></script>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700);

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</html>
