@extends('includes.layout')
@section('content')
<div class="container mb-4 p-1">
    <h1 class="text-center">Create a sale</h1>
    <hr>
    
    <form action="{{ route('sales.store') }}" method="post">
        @csrf
        
        {{-- PRODUCT --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <x-forminputs.select id="product_id"
                name="product_id" placeholder="Choose product" :options="[]" class="mb-md-0" label="Choose product"
                />
            </div>
            <div class="col-md-6">
                <x-forminputs.select
                name="warehouse_id" placeholder="Choose warehouse to sell from" :options="[]" class="mb-md-0" label="Choose warehouse to sell from"
                />
            </div>
            
        </div>
        
        {{-- QUANTITY + DATE --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <x-forminputs.text type="number" name="quantity" label="Enter quantity" class="mb-md-0"/>
            </div>
            
            <div class="col-md-6">
                <x-forminputs.text name="sale_date" label="Choose transaction date"
                id="nepali-datepicker" autocomplete="off"/>
            </div>
        </div>
        
        {{-- customer --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <x-forminputs.text type="text" name="customer_full_name" label="Customer Full Name" class="mb-md-0"/>
                
            </div>
            <div class="col-md-4">
                <x-forminputs.text type="number" name="customer_phone_number" label="Customer Phone Number" class="mb-md-0"/>
                
            </div>
            <div class="col-md-4">
                <x-forminputs.text type="text" name="customer_extra_info" label="Customer Extra Info" class="mb-md-0"/>
                
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
        
    </form>
    
</div>
@endsection
@push('scripts')
<script>

$(document).ready(function () {
    let productSelect = $('#product_id');

    $.get('/products/all-products', function (data) {
        productSelect.empty();
        productSelect.append('<option value="">Select product</option>');

        data.forEach(function (product) {
            productSelect.append(
                `<option value="${product.id}">
                    ${product.name} (Stock: ${product.total_quantity})
                </option>`
            );
        });

        productSelect.trigger('change'); // for select2
    }); 
    $('#product_id').on('change', function () {
        let productId = $(this).val();
        let warehouseSelect = $('#warehouse_id');

        warehouseSelect.empty().append(
            `<option value="">Loading warehouses...</option>`
        );

        if (!productId) {
            warehouseSelect.html(
                `<option value="">Choose warehouse to sell from</option>`
            );
            return;
        }

        $.get(`/products/${productId}/warehouses`, function (data) {
            warehouseSelect.empty();
            warehouseSelect.append(
                `<option value="">Choose warehouse to sell from</option>`
            );

            if (data.length === 0) {
                warehouseSelect.append(
                    `<option value="">No stock available</option>`
                );
            }

            data.forEach(function (warehouse) {
                warehouseSelect.append(
                    `<option value="${warehouse.id}">
                        ${warehouse.name} (Stock: ${warehouse.quantity})
                    </option>`
                );
            });

            warehouseSelect.trigger('change');
        });
    });

});
</script>
@endpush
