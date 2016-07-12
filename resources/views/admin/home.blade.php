@extends('admin.layouts.masternav')


@section('page')
        
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="huge"> <a style="color: white" href="{{ url('admin/articles') }}" title="Manange Articles"> Articles </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="huge"> <a style="color: white" href="{{ url('admin/sections') }}" title="Manange Sections"> Sections </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection