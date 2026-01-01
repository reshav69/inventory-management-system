@extends('includes.layout')

@section('content')

<div class="p-2 overflow-scroll card mt-3" >
    
    <div class="card-header d-flex justify-content-between">
        <div>
            <i class="fas fa-table me-1"></i>
            {{ ucfirst($type) }}

        </div>
        
        @if(Auth::user()->role === 'admin' && Route::has($type.'.create'))
        <div class="d-flex gap-2">

            <div class="d-flex justify-content-between">
                <a class="btn btn-success btn-sm" href="{{ route($type.'.create') }}">+ Add New</a>
            </div>
            @if (Route::has($type.'.trash'))
                
                <div class="d-flex justify-content-between">
                    <a class="btn btn-warning btn-sm" href="{{ route($type.'.trash') }}">Trash</a>
                </div>
            @endif
        </div>
        @endif
    </div>
    
    <div class="card-body">
        
        <table id="dynamic-table" class="table table-bordered table-responsive table-striped overflow-scroll mt-2 w-100">
            <thead>
                <tr>
                    <th>SN</th>
                    @foreach ($columns as $col)
                    <th>{{ $col }}</th>
                    @endforeach
                    <th >Action</th>
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
        var table = $('#dynamic-table').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
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