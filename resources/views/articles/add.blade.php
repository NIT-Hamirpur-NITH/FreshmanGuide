@extends('layouts.app')

@section('content')
    
    <div class="container">

        @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif

        <div class="row">
            <form action="{{ url('/add') }}" method="POST" accept-charset="utf-8" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="title"  name='title' placeholder="Enter title for the article">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Create</button>
                </div>
              </div>
                

            </form>         
        </div>
        
    </div>

@endsection