<div class="row">

    <div class="col-md-6">
        <form class="form" action="{{ url('comment') + '/' + $article->searchid }}">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-12 control-label">Comment</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="message" placeholder="Your comment"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </form>        
    </div>

    <div class="col-md-6">
            
    </div>    


    @foreach($comments as $comment)
    <div class="col-sm-6">
        
    </div>
    <div class="col-sm-6">
        
    </div>
    @endforeach
</div>