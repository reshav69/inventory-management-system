@extends('includes.layout')
@section('content')
<div class="container mb-4 p-1">
    <h1 class="text-center">Create a transaction</h1>
    <hr>
    
    <form action="{{ route('stocktransactions.store') }}" method="post">
        @csrf
        
        {{-- PRODUCT --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <x-forminputs.select id="product_id"
                name="product_id" 
                placeholder="Choose product" 
                :options="$products"
                class="mb-md-0"
                label="Choose product"
                />
                <span class="fw-lighter m-0 p-0" id="remaining-products">Remaining: </span>
            </div>
            
            {{-- TRANSACTION TYPE --}}
            <div class="col-md-6">
                <x-forminputs.select 
                name="transaction_type"
                label="Choose transaction type"
                class="mb-md-0"
                placeholder="Choose transaction type"
                :options="['incoming'=>'Incoming','transfer'=>'Transfer','sale'=>'Sale']"
                id="transaction_type"
                />
            </div>
            
        </div>
        
        
        {{-- WAREHOUSE (incoming/sale) --}}
        <div class="row mb-3">
            
            <div class="col-md-6" id="warehouse_section">
                <x-forminputs.select 
                name="warehouse_id" 
                placeholder="Choose warehouse" 
                :options="$warehouses"
                class="mb-md-0"
                label="Choose Warehouse"
                />
            </div>
        </div>
        
        {{-- TRANSFER: FROM WAREHOUSE --}}
        <div class="row mb-3 d-none" id="from_warehouse_section">
            <div class="col-md-6">
                <x-forminputs.select  id="from_warehouse_id"
                name="from_warehouse_id" 
                placeholder="Choose source warehouse" 
                :options="[]"
                class="mb-md-0"
                label="From Warehouse"
                />
            </div>
            
            {{-- TRANSFER: TO WAREHOUSE --}}
            <div class="col-md-6 d-none" id="to_warehouse_section">
                <x-forminputs.select 
                name="to_warehouse_id" 
                placeholder="Choose destination warehouse" 
                :options="$warehouses"
                class="mb-md-0"
                label="To Warehouse"
                />
            </div>
        </div>
        
        {{-- QUANTITY + DATE --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <x-forminputs.text type="number" name="quantity" label="Enter quantity" class="mb-md-0"/>
            </div>
            
            <div class="col-md-6">
                <x-forminputs.text name="transaction_date" label="Choose transaction date"
                id="nepali-datepicker" autocomplete="off"/>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
        
    </form>
    
</div>
@endsection
@push('scripts')
<script>
    // alert('tst')
    function updateFormVisibility() {
        // console.log('chnage');
        let type = $('#transaction_type').val();
        
        // Hide all
        $('#warehouse_section').addClass('d-none');
        $('#from_warehouse_section').addClass('d-none');
        $('#to_warehouse_section').addClass('d-none');
        
        if (type === 'incoming' || type === 'sale') {
            $('#warehouse_section').removeClass('d-none');
        }
        
        if (type === 'transfer') {
            $('#from_warehouse_section').removeClass('d-none');
            $('#to_warehouse_section').removeClass('d-none');
        }
    }

    
    function getRemainingProductCount(productId){
        $.ajax({
            url: `/products/getProductCount/${productId}`,
            method: 'GET',
            success: function(response) {
                $('#remaining-products').html(
                'Total Quantity(all warehouses): <strong>' + response.total_quantity + '</strong>, ' +
                'Remaining Quantity: <strong>' + response.remaining_quantity + '</strong>'
                );
            },
            error: function(err) {
                console.log('Error fetching remaining quantity:', err);
            }
        });

}

$(document).ready(function() {
    updateFormVisibility();
    
    $('#product_id').on('change',function(){
        // console.log('productId');
        var productId = $(this).val();
        // console.log(productId);
        getRemainingProductCount(productId);
    });
    $('#transaction_type').on('change', function() {
        // console.log('ready')

        updateFormVisibility();
    });

    $('#product_id').on('change', function () {
        let productId = $(this).val();
        let warehouseSelect = $('#from_warehouse_id');

        warehouseSelect.empty().append(
            `<option value="">Loading warehouses...</option>`
        );

        if (!productId) {
            warehouseSelect.html(
                `<option value="">Choose warehouse to transfer from</option>`
            );
            return;
        }

        $.get(`/products/${productId}/warehouses`, function (data) {
            warehouseSelect.empty();
            warehouseSelect.append(
                `<option value="">Choose warehouse to transfer from</option>`
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
