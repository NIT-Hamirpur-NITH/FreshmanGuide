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
        <section class="tiles">
        @if (count($articles) == 0)
            <h4 class="center"> Nothing to show here ...... </h4>
        @endif
        @for ($i = 0; $i < count($articles); ++$i)
            <article class="style{{ ($i%6) + 1 }}">
                <span class="image">
                    <img src={{ url($articles[$i]->cover_photo) }} alt="Section image" />
                </span>
                <a href="{{ url('read') . '/' . $articles[$i]->slug }}">
                    <h3 style="color: #FDD; font-weight: bold;">{{ $articles[$i]->title }}</h3>
                    <div class="content">
                        (Updated :  {{ $articles[$i]->ago() }})
                    </div>
                </a>
            </article>
        @endfor
        </section>
    </div>
</div>
@endsection