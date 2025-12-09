@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Add a transaction</h1>
        <hr>
        <form action="{{ route('stocktransactions.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.select name="product_id" placeholder="Choose product" :options="$products"
                    class="mb-md-0"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.select name="warehouse_id" placeholder="Choose warehouse" :options="$warehouses"
                     class="mb-md-0"/>
                    
                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.select name="transaction_type" label="Choose transaction type" class="mb-md-0" placeholder="Choose transaction type"
                     :options="['incoming'=>'Incoming','transfer'=>'Transfer','sale'=>'Sale']" />
                    
                </div>
            </div>

            
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text type="number" name="quantity" label="Enter quantity" class="mb-md-0"/>
                </div>
                
                {{-- <div class="col-md-4">
                    <x-forminputs.text type="number" name="price" label="Enter price" class="mb-md-0"/>
                    
                </div> --}}

                <div class="col-md-6">
                    <x-forminputs.text name="transaction_date" label="Choose transaction date" id="nepali-datepicker"/>

                    {{-- <input type="text" placeholder="Choose date" name="transaction_date" class="form-control mb-md-0" id="nepali-datepicker"> --}}
                    
                </div>
                
            </div>
            

            <button type="submit" class="btn btn-primary">Add Product</button>

        </form>

    </div>
@endsection