@extends('includes.layout')

@section('content')
@if(Auth::user()->role==='admin')
<h1>Admin Dashboard</h1>
@else
<h1>Staff Dashboard</h1>

@endif
<p>
    THis is chart area
</p>
<div>

    <div class="border p-2">
       @include("dashboard._cards") 
    </div>
    <div class="row mt-3">
        <div class="col-md-8">
            @include('dashboard.widgets.warehousestock',['warehouseStocks'=>$warehouseStocks])

        </div>
        <div class="col-md-4">
            @include('dashboard.widgets.stockhealth', ['stockHealth' => $stockHealth])
        </div>    
    </div>
    <div class="row mt-3 mb-3">
       <div class="col-md-6">
           
            @include('dashboard.widgets.salestrend',['salesTrend'=>$salesTrend])
       </div> 

       <div class="col-md-6">
           
        @include('dashboard.widgets.topproducts', ['salesTrend' => $topProducts])
       </div>
    </div>


</div>
@endsection
