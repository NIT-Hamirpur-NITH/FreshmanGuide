@extends('layouts.app')

@section('content')

    <br>
    <br>
    <div class="container">
        <a href="{{ url('admin/articles') }}" title="Manage Articles"> Articles </a> <br>
        <a href="{{ url('admin/sections') }}" title="Manage Sections"> Sections </a> <br>
    </div>

@endsection