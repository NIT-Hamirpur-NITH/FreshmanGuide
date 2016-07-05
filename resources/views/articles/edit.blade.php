@extends('layouts.main')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/content-tools.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/libs/vex/vex.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/libs/vex/vex-theme-os.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/editor.css') }}">
@endsection


@section('content')

    <div class="container">
    
        <section id="article">
        
    
        <div id='article-title'>
            <h2> <i class="fa fa-chevron-circle-right"></i> &nbsp; <span id="title"> {{ $article->title }} </span> <span id="editTitle" > &nbsp; <i class="fa fa-pencil-square-o"></i> Edit </span></h2>
        </div> 

        <div data-editable data-name='content'>


                @if ($article->content == '')

                    <h2>
                        How do I edit?
                    </h2>
                    <p>
                        Click on the pencil button on the lop left, to start editing
                    </p>
                    <img alt="" class="align-right" data-ce-max-width="600" height="275" src="{{ url('assets/editor/images/pic13.jpg') }}" width="358">
                    <h2>
                        What can I do with it?
                    </h2>
                    <ul>
                        <li>
                            Click on any page element to edit it
                        </li>
                        <li>
                            To enter new elements just press enter
                        </li>
                        <li>
                            To change the type of element, use the toolbox
                        </li>
                        <li>
                            You can very easily upload images, and resize and place them to your liking
                        </li>
                    </ul>
                    <h2>
                        Can I edit this article again?
                    </h2>
                    <p>
                        Each article has a unique ID, if you know the id, then you can edit the article. Just use the exact same URL in the location bar to edit. We will be adding some better functionality later.
                    </p> 


                @else

                    {!! $article->content !!}

                @endif    
            </div>
        </section>
    </div>

@endsection

@section('scripts')
<script>
    window.appURL = "{{ url('/') }}";
    window.articleID = "{{ $article->searchid }}";
    console.log(appURL);
</script>
<script src="{{ url('assets/editor/content-tools.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ url('assets/libs/noty.min.js') }}"></script>
<script src="{{ url('assets/libs/vex/vex.combined.min.js') }}"></script>
<script src="{{ url('assets/editor/editor.js') }}" type="text/javascript"></script>
@endsection