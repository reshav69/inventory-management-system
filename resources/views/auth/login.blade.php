@extends('includes.welayout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <x-forminputs.text type="email" name="email" label="Enter Email" class="mb-md-0"/>
                        </div>
                        <div class="form-floating mb-3">
                            <x-forminputs.text type="password" autocomplete="on" name="password" label="Enter password"/>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between">
                            <button class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="{{route('register')}}">Need an account? Sign up!</a></div>
                </div>
            </div>

        </div>
    </div>
    @endsection
