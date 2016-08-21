@extends('admin.layouts.masternav')

@push('styles')
    @include('admin.partials.datatableCSS')
@endpush

@section('page')

<div class="row">
  <div class="col-lg-12">
      <h4 class="page-header">Papers</h4>
  </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row" style="padding-bottom: 2em;">
  <a id='add-paper' class="btn btn-primary" href="{{ url('/admin/paper') }}" target="_blank"> Add Paper </a>
</div>

<div class="row">
  <table class="table table-bordered" id="paper-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Year</th>
        <th>Type</th>
      </tr>
    </thead>
  </table>
</div>

@endsection

@push('scripts')
  @include('admin.partials.datatableJS')
  <script>
  window.appURL = "{!! url('') !!}";

  $(function() {
    window.table = $('#paper-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! url('admin/paper') !!}',
      columns: [
        { data: 'id', name: 'id' },
        { data: 'year', name: 'year' },
        { data: 'type', name: 'type' }
      ],
    });
  });
  </script>
  <!-- <script src="{{ url('assets/admin/adminPaper.js') }}"></script> -->
@endpush
