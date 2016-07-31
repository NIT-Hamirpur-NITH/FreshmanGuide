@extends('layouts.main')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/content-tools.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/editor.css') }}">
@endsection

@section('content')

    <div class="container">
        
        <section id="article">
            
        
        <div id='article-title'>
            <h2> <i class="fa fa-chevron-circle-right"></i> &nbsp; {{ $article->title }}</h2>
        </div> 

        <div data-editable data-name='content'>

            @if ($article->content == '')
                No content, sorry
            @else

                {!! $article->content !!}

            @endif    
        </div>

        </section>

    </div>   

@endsection
