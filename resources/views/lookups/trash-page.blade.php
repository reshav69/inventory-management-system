@extends('includes.layout')

@section('content')

<div class="p-2 overflow-scroll card mt-3" >
    
    <div class="card-header d-flex justify-content-between">
        <div>
            <i class="fas fa-table me-1"></i>
            {{ ucfirst($type) }}

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
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: '{{ $dataUrl }}',
            dom: 'Blfrtip',
            order: [[0, 'asc']],
            xhrFields: {
                withCredentials: true
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: 'false', orderable: 'false' },
                ...@json($columnsConfig),
                { data: 'action', orderable: false, searchable: false },
            ],
            columnDefs: [
                { width: "fit", targets: -1 }
            ],
            buttons: [
                
                'copy', 'excel', 'csv', 'pdf', 'print'
            ],

        });
        table.buttons().container().appendTo('#export-buttons');
    });
</script>

@endpush