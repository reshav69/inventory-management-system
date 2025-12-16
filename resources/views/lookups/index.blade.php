@extends('includes.layout')

@section('content')
@if(Auth::user()->role === 'admin' && Route::has($type.'.create'))
    <div class="d-flex justify-content-between mb-2">
        <a class="btn btn-success btn-sm" href="{{ route($type.'.create') }}">+ Add New</a>
    </div>
@endif
<div class="p-2 overflow-scroll card mt-3" >

    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        {{ ucfirst($type) }}
    </div>

    <div class="card-body">

        <table id="dynamic-table" class="table table-bordered table-striped overflow-scroll w-100">
            <thead>
                <tr>
                    <th>SN</th>
                    @foreach ($columns as $col)
                    <th>{{ $col }}</th>
                    @endforeach
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@push('scripts')

<script>
    $(document).ready(function() {
        $('#dynamic-table').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: '{{ $dataUrl }}',
            dom: 'Bfrtip',
            // order: [[0, 'desc']],
            xhrFields: {
                withCredentials: true
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: 'false', orderable: 'false' },
                ...@json($columnsConfig),
                { data: 'action', orderable: false, searchable: false },
            ],
            columnDefs: [
                { width: "fit", targets: -1 }   // last column = action
            ],
            buttons: [
                'copy', 'excel', 'csv', 'pdf', 'print'
            ],
        });
    });
</script>

@endpush