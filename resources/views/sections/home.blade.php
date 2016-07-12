@extends('layouts.main')

@section('stylesBefore')
    <link rel="stylesheet" href="{{ url('assets/phantom/css/main.css') }}" />
@endsection

@section('styles')
    <style>
        #header h1 a:hover {
            border: 0;
            color: #c24923;
            text-shadow: 0.05em 0.075em 0 #f46b45;
        }

    </style>
@endsection

@section('content')
    <div id="main-wrapper">
        <div id="main" class="container">
            <div class="inner">
                <section class="tiles">
                    @for ($i = 0; $i < count($sections); ++$i)
                        <article class="style{{ ($i%6) + 1 }}">
                            <span class="image">
                                @if ($sections[$i]->image)
                                    <img src={{ url($sections[$i]->image) }} alt="Section image" />
                                @else
                                    <img src={{ url('images/sections/default.jpg') }} alt="Section image" />
                                @endif
                            </span>
                            <a href="{{ url('sections') . '/' . $sections[$i]->id . '/articles' }}">
                                <h2 style="color: #FDD">{{ $sections[$i]->name }}</h2>
                                <div class="content">
                                    <p style="color: #BBB; text-align: center">{{ $sections[$i]->description }}</p>
                                </div>
                            </a>
                        </article>
                    @endfor
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('assets/phantom/js/main.js') }}"></script>
@endsection