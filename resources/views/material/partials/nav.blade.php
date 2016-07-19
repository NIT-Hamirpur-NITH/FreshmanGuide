<!-- Navbar -->
<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll headroom">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ url('') }}">
                <div class="logo-container">
                    <div class="logo">
                        <img height=50 src="{{ url('images/logo.png') }}" alt="Freshman Guide Logo" rel="tooltip" title="<b>Freshman Guide</b>, you are welcome" data-placement="bottom" data-html="true">
                    </div>
                </div>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-index">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ url('sections') }}">
                        <i class="material-icons">dashboard</i> Sections
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="material-icons">nature_people</i> About Us
                    </a>
                </li>
                <li>
                    <a id="add-article" href="javascript:void(0)" title="Add artilces" alt='Add articles'>
                        <i class="material-icons">add_box</i> Add
                    </a>
                </li>
                <li>
                    <a href="{{ url('read/the-path-to-follow') }}">
                        <i class="material-icons">event_note</i> Guidelines
                    </a>
                </li>
                <li>
                    <a id="all-articles" href="#articlesModal">
                        <i class="material-icons">chrome_reader_mode</i> All Articles
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
