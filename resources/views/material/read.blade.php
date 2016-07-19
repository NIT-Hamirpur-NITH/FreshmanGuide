@extends('material.layouts.master')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/content-tools.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/editor.css') }}">
@endsection


@section('content')

<div class="header header-filter" style="background-image: url('{{ url('images/header.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="brand">
                    <h2 class="article-title"> {{ $article->title }} </h2>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div data-editable data-name='content'>          
            @if ($article->content == '')
                No content, sorry
            @else
                {!! $article->content !!}

            @endif    
        </div>
    </div>
</div>
@endsection