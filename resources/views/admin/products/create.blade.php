@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Add a product</h1>
        <hr>
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-forminputs.text name="name" label="Enter name" class=""/>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text type="number" name="quantity" label="Enter quantity" class="mb-md-0"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.text type="number" name="price" label="Enter price" class="mb-md-0"/>
                    
                </div>
                
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.textarea name="description" label="Enter Description" />
                    
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.file name="image" label="Upload Image" accept="image/*" />

                    <div>
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="status" value="1" checked>
                            <label class="form-check-label" for="status">
                              Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status" value="0">
                            <label class="form-check-label" for="status">
                              Inactive
                            </label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    {{-- <input type="text" value="0" name="status" hidden> --}}
                    {{-- <x-forminputs.checkbox name="status" label="Active" class=""/> --}}
                    
                </div>
                
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>

        </form>

    </div>
@endsection