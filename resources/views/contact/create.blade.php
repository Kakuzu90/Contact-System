@extends("layout.app")

@section("title")
	Add New Contact
@endsection

@section("content")
	<div class="container">
		<div class="col-xl-6 col-lg-6 col-sm-6 col-11 mx-auto">
			<div class="card shadow-sm mt-5">
				<div class="card-body">
					<h2 class="offset-3">Add Contact</h2>
					<form action="{{ route("contacts.store") }}" method="POST">
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
								<label class="font-weight-bold">Company</label>
							</div>
							<div class="col-sm-9">
								<input type="text" value="{{ old('company') }}" name="company" class="form-control" />
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3 text-right">
								<label class="font-weight-bold">Phone</label>
							</div>
							<div class="col-sm-9">
								<input type="tel" value="{{ old('phone') }}" name="phone" class="form-control" />
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3 text-right">
								<label class="font-weight-bold">Email</label>
							</div>
							<div class="col-sm-9">
								<input type="email" value="{{ old('email') }}" name="email" class="form-control" />
							</div>
						</div>
						<button type="submit" class="btn btn-primary px-5 float-right">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection