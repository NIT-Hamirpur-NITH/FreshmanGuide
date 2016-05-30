<!DOCTYPE html>
<html>
    <head>
            @include('partials.htmlhead')
    </head>

    <body>
        @include('partials.header')
        @include('partials.navigation')
        <!-- content goes here -->
        <!-- Stuff that is common to all pages should
             be written inside this blade file and
             page specific content should be done by
             extending the stuff in the other blade files -->
        @yield('content')
        @include('partials.footer')
    </body>
</html>
