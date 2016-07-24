<div class="row comment-input">
    <form class="form" name='comment-form' action="{{ url('comment') . '/' . $article->searchid }}">
        <div class="form-group">
            <div class="col-md-offset-2 col-sm-6">
                <textarea name="message" class="form-control" id="message" placeholder="Your comment"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-default btn-primary btn-sm">Add Comment</button>
            </div>
        </div>
    </form> 
</div>

<div class="comment-box">
    @foreach($comments as $comment)
       <div class="row">
       
            <div class="col-sm-5 col-md-offset-1 message">
                {{ $comment->message }}
            </div>
            <div class="col-sm-5 reply">
                {{ $comment->reply }}
            </div>

            <div class="col-sm-1">
                <a href="{{ url('comment/hide/') . '/' . $comment->id }}" class="remove-comment btn btn-danger btn-sm btn-simple"> <i class="material-icons">clear</i> </a>
            </div>
        </div>
    @endforeach
</div>
