<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fresh Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('assets/bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('assets/bower/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/bower/vex/css/vex.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/bower/vex/css/vex-theme-top.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/bower/toastr/toastr.min.css') }}" />


    <!-- Custom CSS -->
    <link href="{{ url('assets/sbadmin/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('assets/bower/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/admin/admin.css') }}" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('styles')

</head>

<body>



    @yield('content')


    <div style="padding: 7em;">
        
    </div>

    <!-- jQuery -->
    <script src="{{ url('assets/bower/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('assets/bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('assets/bower/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('assets/sbadmin/js/sb-admin-2.js') }}"></script>
    <script src="{{ url('assets/bower/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('assets/bower/vex/js/vex.combined.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
