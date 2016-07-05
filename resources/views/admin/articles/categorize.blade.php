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

        
        <div class="row">
            Change the section for
            <h3> {{ $article->title }} </h3>
            <form action="{{ url('/admin/categorize') . '/' . $article->searchid }}" method="POST" accept-charset="utf-8" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <select name="section">
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}"> {{ $section->name }} </option>  
                            @endforeach
                        </select>
                    </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Change</button>
                </div>
              </div>
                

            </form>         
        </div>

    </div>

@endsection