@extends('includes.layout')

@section('content')
<div class="p-2 overflow-scroll" >
    <div class="d-flex justify-content-between mb-2">
        
        <a class="btn btn-success btn-sm" href="{{ route($type.'.create') }}">+ Add New</a>
        
    </div>
    
    <table id="dynamic-table" class="table table-bordered table-striped overflow-scroll w-100">
        <thead>
            <tr>
                @foreach ($columns as $col)
                <th>{{ $col['label'] }}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@endsection
@push('scripts')
<script>
    $(function(){
        $('#dynamic-table').DataTable({
            processing: true,
            serverSide: true,
            
            scrollX:true,
            ajax: "{{ $dataUrl }}",
            dom: 'Bfrtip',
            xhrFields: {
                withCredentials: true
            },
            order: [[0, 'desc']],
            columns: [
                @foreach ($columns as $col)
                    {data: "{{ $col['name'] }}"},
                @endforeach
                {data: "action", orderable:false, searchable:false}
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