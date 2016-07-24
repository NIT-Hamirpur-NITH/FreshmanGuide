<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/material/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('images/logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Freshman Guide | {{ $title }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,300i,400,400i,600,600i,700,700i" rel="stylesheet"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="{{ url('assets/material/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/bower/animate.css/animate.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ url('assets/bower/vex/css/vex.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/bower/vex/css/vex-theme-top.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/bower/toastr/toastr.min.css') }}" />
    <link href="{{ url('assets/material/css/material-kit.css') }}" rel="stylesheet"/>
    <link href="{{ url('assets/main/main.css') }}" rel="stylesheet"/>
    <style>
        .wrapper {
            margin-top: -20px;
        }

        .index-page .wrapper > .header {
            min-height: 50vh;
        }

        .index-page .wrapper > article > .header {
            min-height: 50vh;
        }

        .index-page .brand {
            margin-top: 20vh;
        }
    </style>
    @yield('styles')

</head>

<body class="{{ $bodyClass }}">
    
    @include('material.partials.nav');

    <div class="wrapper">

        @yield('content')
    

        @include('material.partials.footer')

    </div>

    <div id="articlesModal">
        <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->

        <div class="close-articlesModal btn-close-modal" > 
            <button class="btn btn-danger"> <i class="material-icons">clear</i> Close </button>
        </div>
            
        <div class="modal-content">
            @include('material.partials.articles-nav')
        </div>

    </div>

</body>

    <script>
        window.appURL = "{{ url('/') }}";
        window.articles = false;
    </script>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/material/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/material/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/material/js/material.min.js') }}"></script>

    {{-- Headroom for the hiding headers --}}
    <script src="{{ url('assets/bower/headroom.js/dist/headroom.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/bower/headroom.js/dist/jQuery.headroom.min.js') }}" type="text/javascript"></script>

    {{-- Blocking the UI --}}
    <script src="{{ url('assets/bower/blockUI/jquery.blockUI.js') }}"></script>

    {{-- For notification and dialogs --}}
    <script src="{{ url('assets/bower/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('assets/bower/vex/js/vex.combined.min.js') }}"></script>

    {{-- Fullscrenn modal for articles navigation --}}
     <script src="{{ url('assets/libs/animatedModal.min.js') }}"></script>



    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    {{-- <script src="../assets/js/nouislider.min.js" type="text/javascript"></script> --}}

    <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    {{-- <script src="../assets/js/bootstrap-datepicker.js" type="text/javascript"></script> --}}

    @yield('stylesBefore')
    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="{{ url('assets/material/js/material-kit.js') }}"  type="text/javascript"></script>
    @yield('scripts')
</html>
