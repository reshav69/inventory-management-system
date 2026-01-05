@extends('includes.layout')

@section('content')

<div class="p-2 overflow-scroll card mt-3" >

    <div class="card-header d-flex justify-content-between">
        <div>
            <i class="fas fa-table me-1"></i>
            {{ ucfirst($type).' Trash' }}

        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-primary btn-sm" href="{{ route($type.'.index') }}"><i class="fa fa-arrow-left"></i>Go Back</a>
        </div>
    </div>

    
    <div class="card-body">

        <table id="trash-table" class="table table-bordered table-striped overflow-scroll mt-2 w-100">
            <thead>
                <tr>
                    <th>SN</th>
                    @foreach ($columns as $col)
                    <th>{{ $col }}</th>
                    @endforeach
                    <th aria-controls="trash-table" tabindex="0">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<div id="export-buttons" class="card mt-5 mb-5  p-2"></div>

@endsection
@push('scripts')

<script>
        $(document).ready(function() {
        var table = $('#trash-table').DataTable({
            processing: true,
            serverSide: true,
            responsive:true,
            ajax: '{{ $dataUrl }}',
            xhrFields: {
                withCredentials: true
            },
            layout:{
                topStart: 'pageLength',
                top:'buttons',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: 'false', orderable: 'false' },
                ...@json($columnsConfig),
                { data: 'action', orderable: false, searchable: false },
            ],
            columnDefs: [
                { width: "fit-content", targets: -1 }
            ],
            buttons: [
                'copy', 'excel', 'csv', 'pdf', 'print'
            ],

        });
        table.buttons().container().appendTo('#export-buttons');
    });
    
</script>

@endpush