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

                <p class="alert alert-danger">
                    The above element is used to extract the heading for this article, so please do not delete, however you can edit it. If you add any more element they will be ignored
                </p>
                <h3>
                    How do I edit?
                </h3>
                <p>
                    Click on the pencil button on the lop left, to start editing
                </p>
                <img alt="" class="align-right" data-ce-max-width="600" height="170" src="http://localhost:8000/assets/editor/images/pic13.jpg" width="600">
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
                        You can very easily upload images, and resize and place them you yours likings
                    </li>
                </ul>
                <h3>
                    Can I edit this article again?
                </h3>
                <p>
                    Each article has a unique ID, if you know the id, then you can edit the article. You can find the id in the URL, it's the thing starting with 'article'. We will be adding some better functionality later.
                </p> 


            @else

                {!! $article->content !!}

            @endif    
        </div>

    </div>   

@endsection

@section('scripts')
<script src="/assets/editor/content-tools.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/libs/noty.min.js"></script>
<script src="/assets/editor/editor.js" type="text/javascript"></script>
@endsection