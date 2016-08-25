@extends('admin.layouts.masternav')

@section('page')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add New Section </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">

  <div class="container">

    @if (session('error'))
    <div class="alert alert-error">
      {{ session('error') }}
    </div>
    @endif

    <div class="row">
      <form action="{{ url('/admin/sections/add') }}" method="POST" accept-charset="utf-8" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name"  name='name' placeholder="Enter the name of the section" required>
          </div>
        </div>
        <div class="form-group">
          <label for="desc" class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="desc"  name='desc' placeholder="Enter a short description of the article" required>
          </div>
        </div>
        <div class="form-group">
          <label for="image" class="col-sm-2 control-label">Image</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="image"  name='image' placeholder="Image for the section">
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

</div>

@endsection
