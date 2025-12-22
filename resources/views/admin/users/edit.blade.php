@extends('includes.layout')
@section('content')
    <div class="container mb-4 p-1">
        <h1 class="text-center">Edit user {{$user->name}}</h1>
        <hr>
        <form action="{{ route('users.update',$user->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text name="first_name" label="Enter First Name" class="mb-md-0" :value="$user->first_name"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.text name="last_name" label="Enter Last Name" class="mb-md-0" :value="$user->last_name"/>                    
                </div>
                
            </div>
                       
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.text type="email" name="email" label="Enter Email" class="mb-md-0" :value="$user->email"/>
                </div>
                
                <div class="col-md-6">
                    <x-forminputs.text type="password" autocomplete="on" name="password" label="Change password"
                    class="mb-md-0"/>

                    <small class="text-muted">Leave blank to keep the current password.</small>
                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-forminputs.select name="role" placeholder="Choose role" :options="['staff'=>'Staff','admin'=>'Admin']"
                    class="mb-md-0" label="Choose Role" :selected="$user->role"
                    />
                </div>
                
                <div class="col-md-6 d-flex align-items-center">
                    <x-forminputs.status-radio :check="$user->status"/>
                    
                </div>

            </div>
            <hr>
            
            <button type="submit" class="btn btn-primary">Update User</button>

        </form>

    </div>
@endsection