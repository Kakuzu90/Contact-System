@extends("layout.auth")

@section("title")
	Welcome | Contact System
@endsection

@section("content")
<div class="card shadow-sm">
	<div class="card-body">
		<h3 class="offset-3 card-title">Sign In</h3>
		<form action="{{ route("login.stored") }}" method="POST">
			@csrf
			<div class="row mb-3">
				<div class="col-sm-3 text-right">
					<label class="font-weight-bold">Email Address</label>
				</div>
				<div class="col-sm-9">
					<input type="email" value="{{ old("email") }}" name="email" class="form-control @error("login_failed") is-invalid @enderror" required />
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3 text-right">
					<label class="font-weight-bold">Password</label>
				</div>
				<div class="col-sm-9">
					<input type="password" name="password" class="form-control" required />
				</div>
			</div>
			<button type="submit" class="btn btn-primary px-5 float-right">Submit</button>
		</form>
		@error("login_failed")
			<p class="text-center text-danger">{{ $message }}</p>
		@enderror
	</div>
</div>

<div class="mt-3 text-center">
	<p>New User? Create an account <a href="{{ route("register") }}">here</a></p>
</div>
@endsection