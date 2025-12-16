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
            {{-- {{ $product }} --}}
            <div class="col-md-6">
                @if ($product->image_path)
                <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="img-fluid img-thumbnail" id="image"
                    style="max-height:150px;">
                <x-forminputs.file name="image" label="Change Image" accept="image/*" />
                
                @else
                <x-forminputs.file name="image" label="Upload Image" accept="image/*" />
                @endif



                <div>
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status_active" value="1"
                        @if ($product->status == 1)
                        checked
                        @endif >
                        <label class="form-check-label" for="status_active">
                          Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0" @if ($product->status ==0)
                        checked
                        @endif >
                        <label class="form-check-label" for="status_inactive">
                          Inactive
                        </label>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
{{-- 
                <input type="text" value="0" name="status" hidden>
                <x-forminputs.checkbox name="status" label="Active" :checked="$product->status" class=""/> --}}
                
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Update</button>

    </form>

</div>
@endsection
