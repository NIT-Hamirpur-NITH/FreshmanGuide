@extends('layouts.main')

<style>
    #section-title h2 {
        text-align: center;
        font-family: 'Oleo Script', italic;
        font-size: 2em;
        color: #3e3e4e;
        text-transform: capitalize;
    }

    #articles-list {
        margin-left: 10%;
    }

    #articles-list li:before {
        content: "\0BB \020";
        color: inherit;
        font-size: 1.5em;
        font-weight: 700;
    }

    #articles-list li {
        margin: 0.5em;
        font-family: "Merriweahter", serif;
        color: #2e2e3e;
    }

    #articles-list li a {
        color: inherit;
        font-size: 1.5em;
        font-weight: 700;
    }

    #articles-list li a:link {
        color: inherit;
    }

    #articles-list li a:visited {
        color: inherit;
    }

</style>        

@section('content')

    <div id="main-wrapper">
        <div id="main" class="container">
    
        <div id="section-title">
            <h2> <span> {{ $section->name }} </span>  </h2>
        </div>

        <ul id="articles-list">
            @foreach ($articles as $a)
                <li>
                    <a class="article-link" href="{{ url('/read/') . '/' . $a->slug }}"> {{ $a->title }} </a>
                    <span class="published"> &nbsp; (Updated :  {{ $a->ago() }}) </span>
                </li>
            @endforeach
        </ul>

        </div>
    </div>

@endsection
