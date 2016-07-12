@extends('admin.layouts.master')

@section('content')    
<div id="wrapper">

    @include('admin.partials.nav')

    <div id="page-wrapper">
        @yield('page')
   </div>
   
</div>

@endsection