@extends('includes.layout')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-5">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4">Register</h3>
				</div>
				<div class="card-body">
					<form action="{{ route('register') }}" method="post">
						@csrf
							<div class="mb-2">
								<x-forminputs.text name="first_name" label="Enter First Name" class="mb-md-0"/>
							</div>

							<div class="mb-2">
								<x-forminputs.text name="last_name" label="Enter Last Name" class="mb-md-0"/>
							</div>

							<div class="mb-2">
								<x-forminputs.text type="email" name="email" label="Enter Email" class="mb-md-0"/>
							</div>

							<div class="mb-2">
								<x-forminputs.text type="password" autocomplete="on" name="password" label="Enter password" class="mb-md-0"/>

							</div>

						<button type="submit" class="btn btn-primary">Register</button>

					</form>

				</div>
				<div class="card-footer text-center py-3">
					<div class="small"><a href="{{route('login')}}">Already have an account? Login</a></div>
				</div>
			</div>

		</div>
	</div>

</div>
@endsection