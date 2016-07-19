<!-- Header -->
@if ($bodyClass == 'homepage')

    <div class="navigation">
        <div class="brand">
            <h1> Freshman Guide </h1>
        </div>
        <nav class="nav-collapse menu">
            <ul>
                @include('main.partials.navItems')
            </ul>
        </nav>
    </div>

@else
    

@endif
