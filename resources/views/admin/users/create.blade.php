@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Add a user</h1>
        <hr>
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text name="first_name" label="Enter First Name" class="mb-md-0"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.text name="last_name" label="Enter Last Name" class="mb-md-0"/>                    
                </div>
                
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text type="email" name="email" label="Enter Email" class="mb-md-0"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.text type="password" autocomplete="on" name="password" label="Enter password"
                    class="mb-md-0"/>
                    
                </div>
                
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.select name="role" placeholder="Choose role" :options="['staff'=>'Staff','admin'=>'Admin']"
                    class="mb-md-0" label="Choose Role"
                    />
                </div>
                
                <div class="col-md-6 d-flex align-items-center">
                    <x-forminputs.status-radio />
                    
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Add user</button>

        </form>

    </div>
@endsection