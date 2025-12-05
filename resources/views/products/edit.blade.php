@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Edit {{$product->name}}</h1>
        <hr>
        <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-forminputs.text name="name" label="Enter name" :value="$product->name" class=""/>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text type="number" name="quantity" label="Enter quantity" :value="$product->quantity"
                        class="mb-md-0"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.text type="number" name="price" label="Enter price" :value="$product->price"
                    class="mb-md-0"/>
                    
                </div>
                
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.textarea name="description" label="Enter Description" :value="$product->description" />
                    
                </div>
                {{ $product }}
                <div class="col-md-6">
                    @if ($product->image_path)
                    <img src="{{ asset('storage/'.$produuct->image_path) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height:150px;">
                        
                    @endif
                    <x-forminputs.file name="image" label="Upload Image" accept="image/*" />
                    <input type="text" value="0" name="status" hidden>
                    <x-forminputs.checkbox name="status" label="Active" class=""/>
                    
                </div>
                
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>

        </form>

    </div>
@endsection