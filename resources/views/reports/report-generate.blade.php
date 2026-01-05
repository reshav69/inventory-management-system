@extends('includes.layout')

@section('content')
<form method="POST" action="{{ route('reports.generate') }}">
    @csrf

    <div class="row mb-3">
        <div class="col-md-4">
            
        <x-forminputs.select name="report_type" :options="['sales'=>'Sales Report','inventory'=>'Inventory Report']" label="Choose Report type"/>
        </div>
        <div class="col-md-4">
        <x-forminputs.select name="period" :options="['today'=>'Today','month'=>'Current Month','year'=>'Current Year','week'=>'Current Week','all'=>'All']" label="Choose Period"/>
        </div>

    </div>

    <button class="btn btn-primary">Generate</button>
    {{-- <button name="export" value="excel" class="btn btn-success">
        Export Excel
    </button> --}}
</form> 
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.nepali-datepicker').forEach(wrapper => {
        const input = wrapper.querySelector('input');

        if (!input) return;

        if (typeof input.NepaliDatePicker !== 'function') {
            console.error('NepaliDatePicker not loaded for:', input);
            return;
        }

        input.NepaliDatePicker({
            mode: 'dark',
            disableDaysAfter: 1,
            animation: 'slide',
        });
    });
});
</script>

@endpush