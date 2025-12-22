@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Edit warehouse {{$warehouse->name}}</h1>
        <hr>
        <form action="{{ route('warehouses.update',$warehouse->id) }}" method="post">
            @csrf
            @method('PATCH')
            <x-forminputs.text name="name" label="Enter name" :value="$warehouse->name"/>
            <x-forminputs.text name="location" label="Enter location" :value="$warehouse->location"/>

            <x-forminputs.status-radio />
            <hr>
            
            <button type="submit" class="btn btn-primary">Update Warehouse</button>

        </form>

    </div>
@endsection