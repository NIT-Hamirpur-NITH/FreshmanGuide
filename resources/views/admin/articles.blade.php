@extends('admin.layouts.masternav')

@push('styles')
    @include('admin.partials.datatableCSS')
@endpush

@section('page')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row" style="padding-bottom: 2em;">

    <a class="btn btn-primary" href="{{ url('/add') }}" target="_blank"> Add Articles </a>

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


    <table class="table table-bordered" id="articles-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Heading</th>
                <th>Section</th>
                <th>Updated</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

</div>

@endsection

@push('scripts')
    @include('admin.partials.datatableJS')
    <script>
        window.appURL = "{!! url('') !!}";
        window.sections = JSON.parse('{!! $sections !!}');

        $(function() {
            window.table = $('#articles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('admin/articles-data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'section', name: 'section', orderable: false, searchable: false },
                    { data: 'updated_at', name: 'updated_at', orderable: false, searchable: false},
                    { data: 'published', name: 'published', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    <script src="{{ url('assets/admin/admin.js') }}"></script>
@endpush