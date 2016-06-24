@extends('layouts.app')

@section('content')

    <div class="container">

        @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($articles->isEmpty())
            There seems to be no articles
        @else
        <table class="table table-striped table-bordered">
            <caption>All the articles</caption>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Heading</th>
                    <th>SearchId</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Updated</th>
                    <th>Read</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->searchid }}</td>
                        <td>
                            @if ($article->published)
                                <span class="label label-primary">Published</span>
                            @endif
                            @if ($article->edited)
                                <span class="label label-primary">Edited</span>
                            @endif
                            @if ($article->new)
                                <span class="label label-primary">New</span>
                            @endif
                            @if (!$article->new && !$article->edited && !$article->published)
                                <span class="label label-default">Editing</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary btn-sm" target="_blank" href="{{ url('edit/' . $article->searchid) }}" > Edit </a> 
                                <a class="btn btn-danger btn-sm" href="{{ url('admin/delete/' . $article->searchid) }}" > Delete </a> 
                                @if ($article->published)
                                    <a class="btn btn-sm btn-warning" href="{{ url('admin/unpublish/' . $article->searchid) }}" > Unpublish </a>
                                @else
                                    <a class="btn btn-sm btn-success" href="{{ url('admin/publish/' . $article->searchid) }}" > Publish </a>
                                @endif
                            <div>
                        </td>  
                        <td>
                            {{ $article->updated_at }}
                        </td>
                        <td>
                            @if ($article->published)
                                <a class="btn btn-info btn-sm" target="_blank" href="{{ url('read/' . $article->slug) }}" title="{{ $article->title }}"> Read </a>
                            @else
                                <button disabled='disabled' class="btn btn-info btn-sm" title="{{ $article->title }}"> Read </button>
                            @endif
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

@endsection