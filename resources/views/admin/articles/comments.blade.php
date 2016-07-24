@extends('admin.layouts.masternav')

@section('page')
    
<div class="row">
    <div class="col-lg-12">
        <h5 class="page-header"> Comments for <strong>{{ $article->title }}</strong> </h5>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="container comment-box">
        @foreach($comments as $comment)
           <div class="row {{ ($comment->hide ? 'hidden-comment' : '') }}">
           
                <div class="col-sm-5 col-md-offset-1 message">
                    {{ $comment->message }}
                </div>
                <div class="col-sm-5 reply">
                    {{ $comment->reply }}
                    @if ($comment->reply == '')
                        <a href="{{ url('admin/comment/reply/') . '/' . $comment->id }}" class="reply-comment btn btn-sm btn-primary"> Reply </a>
                    @else
                        <a href="{{ url('admin/comment/reply/') . '/' . $comment->id }}" class="reply-comment btn btn-sm btn-primary"> New Reply </a>
                    @endif
                </div>

                <div class="col-sm-1">
                    <a href="{{ url('admin/comment/delete/') . '/' . $comment->id }}" class="delete-comment btn btn-danger"> <i class="fa fa-close"></i> </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ url('assets/admin/admin.js') }}"></script>
@endpush