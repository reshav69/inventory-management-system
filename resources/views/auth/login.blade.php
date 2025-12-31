@extends('includes.layout')
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

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
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