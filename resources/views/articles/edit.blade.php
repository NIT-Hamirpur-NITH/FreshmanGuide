@extends('layouts.app')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/content-tools.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/editor.css') }}">
@endsection


@section('content')

    <div class="container">
        
        <div data-editable data-name='heading' class="jumbotron">
            <h2 id="title">{{ $article->title }}</h2>
        </div> 

        <div data-editable data-name='content'>
            
            @if ($article->content == '')

                <p class="alert alert-danger">
                    The above element (title section) is used to extract the heading for this article, so please do not delete, however you can edit it. If you add any more element to the title section they will be ignored
                </p>
                <h3>
                    How do I edit?
                </h3>
                <p>
                    Click on the pencil button on the lop left, to start editing
                </p>
                <img alt="" class="align-right" data-ce-max-width="600" height="275" src="{{ url('assets/editor/images/pic13.jpg') }}" width="358">
                <h3>
                    What can I do with it?
                </h3>
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
                <h3>
                    Can I edit this article again?
                </h3>
                <p>
                    Each article has a unique ID, if you know the id, then you can edit the article. Just use the exact same URL in the location bar to edit. We will be adding some better functionality later.
                </p> 


            @else

                {!! $article->content !!}

            @endif    
        </div>

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
<script src="{{ url('assets/editor/editor.js') }}" type="text/javascript"></script>
@endsection