@extends('includes.layout')

@section('content')
<div class="p-2 overflow-scroll" >
    {{-- <div class="d-flex justify-content-between mb-2">
        
        <button class="btn btn-success btn-sm  open-modal" data-url="{{ $createUrl }}" data-title="Create {{ $title }}">+ Add New</button>
        <a class="btn btn-warning btn-sm" href={{ ($trashPage) }} data-title="view trash">View Trash</a>
        
    </div> --}}
    
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
            buttons: [
            'copy', 'excel', 'csv', 'pdf', 'print'
            ],
        });
    });
</script>
@endpush