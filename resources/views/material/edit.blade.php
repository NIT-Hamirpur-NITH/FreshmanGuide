@extends('material.layouts.master')

@section('styles')    
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/content-tools.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/editor/editor.css') }}">
@endsection

@section('content')

<div class="header header-filter header-article" style="background-image: url('{{ url('images/header.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="brand">
                    <h2 class="article-title"> {{ $article->title }}  </h2>
                    <p>
                        <button type="button" id='edit-title' class="btn btn-success btn-sm"> <i class="material-icons">create</i> Edit Title  </button>
                        <button type="button" class="btn btn-info btn-sm"> <i class="material-icons">comment</i> Comment  </button>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="main main-raised">
    <div class="container">
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
        <div class="grain">
            <i class="material-icons">grain</i>
            END
            <i class="material-icons">grain</i>
        </div>
    </div>
</div>

<div id="commentModal">
    <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->

    <div class="close-commentModal btn-close-modal" > 
        <button class="btn btn-sm btn-danger"> <i class="material-icons">clear</i></button>
    </div>
        
    <div class="modal-content">
        @include('material.partials.comments')
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
<script src="{{ url('assets/editor/editor.js') }}" type="text/javascript"></script>
@endsection