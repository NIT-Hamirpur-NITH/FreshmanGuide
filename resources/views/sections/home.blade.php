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
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('assets/phantom/js/main.js') }}"></script>
@endsection