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
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" />
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="#">Need an account? Sign up!</a></div>
            </div>
        </div>

    </div>
</div>

@endsection