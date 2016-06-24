@extends('layouts.app')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="/assets/editor/content-tools.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/editor/editor.css">
@endsection

@section('content')

    <div class="container">
        
        <div data-editable data-name='heading' class="jumbotron">
            <h2 id="title">{{ $article->title }}</h2>
        </div> 

        <div data-editable data-name='content'>
            
            @if ($article->content == '')
                No content, sorry
            @else

                {!! $article->content !!}

            @endif    
        </div>

    </div>   

@endsection
