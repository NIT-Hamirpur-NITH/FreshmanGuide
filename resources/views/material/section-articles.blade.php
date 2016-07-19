@extends('material.layouts.master')

@section('content')

<div class="header header-filter" style="background-image: url('{{ url('images/header.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="brand">
                    <h2> {{ $section->name }} </h2>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <ul class="list-unstyled articles-list">
        @foreach ($articles as $a)
            <li>
                <a class="article-link" href="{{ url('/read/') . '/' . $a->slug }}"> <i class="material-icons">done_all</i> {{ $a->title }} </a>
                <span class="published"> &nbsp; (Updated :  {{ $a->ago() }}) </span>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection