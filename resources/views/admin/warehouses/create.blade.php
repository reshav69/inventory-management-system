@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Add a warehouse</h1>
        <hr>
        <form action="{{ route('warehouses.store') }}" method="post">
            @csrf
            <x-forminputs.text name="name" label="Enter name" />
            <x-forminputs.text name="location" label="Enter location" />

            <x-forminputs.status-radio/>
            <hr>
            {{-- <input type="text" value="0" name="status" hidden>
            <x-forminputs.checkbox name="status" label="Active" class=""/> --}}
            
            <button type="submit" class="btn btn-primary">Add Warehouse</button>

        </form>

    </div>
@endsection