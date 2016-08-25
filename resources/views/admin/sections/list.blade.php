@extends('admin.layouts.masternav')

@section('page')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sections</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row" style="padding-bottom: 2em;">
  <a class="btn btn-primary" href="{{ url('/admin/sections/add') }}"> Add Sections </a>
</div>

<div class="row">

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

  @if (count($sections) == 0)
  There seems to be no sections
  @else
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> Id </th>
        <th> Name </th>
        <th> Description </th>
        <th> Image </th>
        <th> Action </th>
        <th> Articles </th>
      </tr>
    </thead>
    <tbody>
      @foreach($sections as $section)
      <tr>
        <td> {{ $section->id }} </td>
        <td> {{ $section->name }} </td>
        <td> {{ $section->description }} </td>
        <td>
          @if (!$section->image)
          No image added
          @else
          {{ $section->image }}
          @endif
        </td>
        <td>
          <a class="btn btn-danger btn-sm" href='{{ url('admin/sections/delete/' . $section->id) }}'> Delete  </a>
          <a class="btn btn-success btn-sm" href='{{ url('admin/sections/edit/' . $section->id) }}'> Edit  </a>
          <a class="btn btn-primary btn-sm" href='{{ url('admin/sections/artilces/' . $section->id) }}'> View Articles  </a>
        </td>
        <td>
          {{ count($section->articles) }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif

</div>

@endsection
