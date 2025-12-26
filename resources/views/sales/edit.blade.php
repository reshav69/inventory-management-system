@extends('includes.layout')
@section('content')
<div class="container mb-4 p-1">
    <h1 class="text-center">Update the sale</h1>
    <hr>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Warehouse</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Sale Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sale->product->name }}</td>
                <td>{{ $sale->warehouse->name }}</td>
                <td>{{ $sale->product->price }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ $sale->total_amount}}</td>
                <td>{{ $sale->sale_date }}</td>
            </tr>
        </tbody>
    </table>
    <i class="card p-3 m-3">If you want to edit these information, refund and create a new sale</i>


    
    <form action="{{ route('sales.update',$sale->id) }}" method="post">
        @csrf
        @method('PATCH')
        {{-- customer --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <x-forminputs.text type="text" name="customer_full_name" label="Customer Full Name"
                class="mb-md-0" :value="$sale->customer_full_name"/>
                
            </div>
            <div class="col-md-4">
                <x-forminputs.text type="number" name="customer_phone_number" label="Customer Phone Number"
                class="mb-md-0" :value="$sale->customer_phone_number" />
                
            </div>
            <div class="col-md-4">
                <x-forminputs.text type="text" name="customer_extra_info" label="Customer Extra Info"
                class="mb-md-0" :value="$sale->customer_extra_info" autocomplete="off"/>
                
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        
    </form>
    <hr>
    <form action="{{route('sales.refund',$sale->id)}}" method="post" class="refund-btn">
        @csrf
        <button class="btn btn-success">Refund</button>
    </form>
    
</div>
<script>
    text = 'You are about to refund this sale! This cannot be undone. You can recreate a new sale after refund'
    document.addEventListener('submit', function (e) {

        if (e.target && e.target.classList.contains('refund-btn')) {
            e.preventDefault();

            const form = e.target;

            Swal.fire({
                title: 'Are you sure?',
                text: `${text}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, refund it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });

</script>
@endsection
