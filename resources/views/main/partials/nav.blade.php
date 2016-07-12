<!-- Header -->
@if ($bodyClass == 'homepage')

    <div id="header-wrapper">
        <div id="header" class="container">
            <!-- Logo -->
            <div>
                <h1 id="logo"><a href="{{ url('/') }}">Freshman Guide</a></h1>
                <p> Add Something Here </p>
            </div>
            
            <!-- Nav -->
            <nav id="nav">
                <ul>
                    @include('main.partials.navItems')
                </ul>
            </nav>
        </div>
    </div>

@else

    <div id="header-wrapper" class="small">
        <div id="header" class="small" class="container">
            <!-- Logo -->
            <div>
                <h1 id="logo"><a href="{{ url('/') }}">Freshman Guide</a></h1>
            </div>
            
            <!-- Nav -->
            <nav id="nav">
                <ul>
                    @include('main.partials.navItems')
                </ul>
            </nav>
        </div>
    </div>

    

@endif
