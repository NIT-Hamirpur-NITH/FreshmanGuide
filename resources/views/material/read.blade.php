@extends('material.layouts.master')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/content-tools.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/editor.css') }}">
@endsection


@section('content')

<article>
    
<div class="header header-filter" style="background-image: url('{{ url('images/header.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="brand">
                    <h2 class="article-title"> {{ $article->title }} </h2>
                    <p class="reading-time"> <span class="words"></span> words in probably <span class="eta"></span>, read <span class="visits"> {{ $article->visits }} </span> times </p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div data-editable data-name='content'>      
            {{-- <p><small><span class="eta"></span> (<span class="words"></span> words)</small></p>     --}}
            @if ($article->content == '')
                No content, sorry
            @else
                {!! $article->content !!}

            @endif    
        </div>
    </div>
</div>

</article>
@endsection


@section('scripts')
    <script src="{{ url('assets/bower/reading-time/build/readingTime.min.js') }}"></script>
    <script>
        $(function() {
            $('article').readingTime({
                readingTimeTarget: '.reading-time .eta',
                wordCountTarget: '.reading-time .words',
                success: function() {
                    console.log('It worked!');
                },
                error: function(message) {
                    console.log(message);
                    $('.reading-time').remove();
                }
            });
        });
    </script>   
@endsection