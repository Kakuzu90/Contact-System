@extends("layout.auth")

@section("title")
	Register | Contact System
@endsection

@section("content")
<div class="card shadow-sm">
	<div class="card-body">
		<h3 class="offset-3 card-title">Registration</h3>
		<form action="{{ route("register.stored") }}" method="POST">
			@csrf
			<div class="row mb-3">
				<div class="col-sm-3 text-right">
					<label class="font-weight-bold">Name</label>
				</div>
				<div class="col-sm-9">
					<input type="text" value="{{ old('name') }}" name="name" class="form-control" required/>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3 text-right">
					<label class="font-weight-bold">Email Address</label>
				</div>
				<div class="col-sm-9">
					<input type="email" value="{{ old('email') }}" name="email" class="form-control @error("email") is-invalid @enderror" required />
					@error("email")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3 text-right">
					<label class="font-weight-bold">Password</label>
				</div>
				<div class="col-sm-9">
					<input type="password" name="password" class="form-control @error("password") is-invalid @enderror" required />
					@error("password")
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-3 text-right">
					<label class="font-weight-bold">Confirm Password</label>
				</div>
				<div class="col-sm-9">
					<input type="password" name="password_confirmation" class="form-control @error("password") is-invalid @enderror" required />
				</div>
			</div>
			<button type="submit" class="btn btn-primary px-5 float-right">Submit</button>
		</form>
	</div>
</div>


<div class="mt-3 text-center">
	<p>Already have an account? Click <a href="{{ route("login") }}">here</a></p>
</div>
@endsection