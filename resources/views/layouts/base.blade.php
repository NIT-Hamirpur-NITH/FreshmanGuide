<!DOCTYPE html>
<html>
    <head>
            <title>
                Freshman Guide - @yield('title')
            </title>
    </head>

    <body>
        <!-- content goes here -->
        <!-- Stuff that is common to all pages should
             be written inside this blade file and
             page specific content should be done by
             extending the stuff in the other blade files -->
        @yield('content')
    </body>
</html>
