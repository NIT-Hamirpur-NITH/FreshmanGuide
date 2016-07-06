<!DOCTYPE HTML>
<html>
    <head>
        <title>Freshman Guide | {{ $title }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,900,900italic,300italic,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic,300italic,300,900,900italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        @yield('stylesBefore')
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="{{ url('assets/libs/vex/vex.css') }}" />
        <link rel="stylesheet" href="{{ url('assets/libs/vex/vex-theme-os.css') }}" />
        <link rel="stylesheet" href="{{ url('assets/strongly/css/main.css') }}" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <style>

            #header {
                padding: 7em 0em 2em 0em;
            }

            #main-wrapper {
                padding-top: 4em;
            }

            body {
                background-color: rgb(250, 250, 250);
            }
            
            h1, h2, h3, h4, h5, h6 {
                color: #1F1F26;
                font-family: 'Lato', sans-serif;
                font-weight: 700;
                letter-spacing: normal;
            }

            p {
                font-family: 'Merriweather', serif;
                color: #2F2F46;
                font-size: 0.9em;
                line-height: 1.5;
            }

            h1 strong, h2 strong, h3 strong h4 strong, h5 strong, h6 strong {
                color: #0F0F16;   
            }

            a:link {
                border-bottom: 2px inset #a79a9a;
                /*text-decoration: underline;*/
                color: inherit;
            }


            a:hover {
                color: #000;
                border-bottom: 2px inset #000;
            }

            a strong {
                color: inherit;
            }

            a:before {
              content: "";
              position: absolute;
              width: 100%;
              height: 2px;
              bottom: 0;
              left: 0;
              background-color: #000;
              visibility: hidden;
              -webkit-transform: scaleX(0);
              transform: scaleX(0);
              -webkit-transition: all 0.5s ease-in-out 0s;
              transition: all 0.5s ease-in-out 0s;
            }


        </style>
        @yield('styles')
    </head>
    <body class="{{ $bodyClass }}">
        <div id="page-wrapper">

            <!-- Header -->
                <div id="header-wrapper">
                    <div id="header" class="container">

                        <!-- Logo -->
                        <h1 id="logo"><a href="{{ url('/') }}">Freshman Guide</a></h1>
                        <p> Add Something Here </p>
                        
                        <!-- Nav -->
                        <nav id="nav">
                            <ul>
                                <li><a class="icon fa-home" href="{{ url('/') }}"><span>Home</span></a></li>
                                <li> <a href="{{ url('sections') }}" class="icon fa-bar-chart-o"><span>Sections</span></a> </li>
                                <li><a class="icon fa-cog" href="{{ url('contact') }}"><span>Contact Us</span></a></li>
                                <li><a class="icon fa-cog" href="{{ url('read/the-path-to-follow') }}"><span>Guidelines</span></a></li>
                                <li><a class="icon fa-pencil" id="add-article" href="javascript:void(0)"><span>Add</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            @yield('content')
            
            <!-- Footer -->
            <div id="footer-wrapper">
                <div id="copyright" class="container">
                    <ul class="links">
                        <li>Nothing reserved</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Scripts -->
        <script>
            window.appURL = "{{ url('/') }}";
            console.log(appURL);
        </script>
        <script src="{{ url('assets/strongly/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/strongly/js/jquery.dropotron.min.js') }}"></script>
        <script src="{{ url('assets/strongly/js/skel.min.js') }}"></script>
        <script src="{{ url('assets/strongly/js/skel-viewport.min.js') }}"></script>
        <script src="{{ url('assets/strongly/js/util.js') }}"></script>
        <!--[if lte IE 8]><script src="{{ url('assets/strongly/js/ie/respond.min.js') }}"></script><![endif]-->
        <script type="text/javascript" src="{{ url('assets/libs/noty.min.js') }}"></script>
        <script src="{{ url('assets/libs/vex/vex.combined.min.js') }}"></script>
        <script src="{{ url('assets/strongly/js/main.js') }}"></script>
        @yield('scripts')
    </body>
</html>