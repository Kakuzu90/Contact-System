@extends("layout.app")

@section("title")
	Add New Contact
@endsection

@section("content")
	<div class="container">
		<div class="col-xl-6 col-lg-6 col-sm-6 col-11 mx-auto">
			<div class="card shadow-sm mt-5">
				<div class="card-body">
					<h2 class="offset-3">Edit Contact</h2>
					<form action="{{ route("contacts.update", $contact->id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="row mb-3">
							<div class="col-sm-3 text-right">
								<label class="font-weight-bold">Name</label>
							</div>
							<div class="col-sm-9">
								<input type="text" value="{{ $contact->name }}" name="name" class="form-control" required/>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3 text-right">
								<label class="font-weight-bold">Company</label>
							</div>
							<div class="col-sm-9">
								<input type="text" value="{{ $contact->company }}" name="company" class="form-control" />
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3 text-right">
								<label class="font-weight-bold">Phone</label>
							</div>
							<div class="col-sm-9">
								<input type="tel" value="{{ $contact->phone }}" name="phone" class="form-control" />
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-sm-3 text-right">
								<label class="font-weight-bold">Email</label>
							</div>
							<div class="col-sm-9">
								<input type="email" value="{{ $contact->email }}" name="email" class="form-control" />
							</div>
						</div>
						<button type="submit" class="btn btn-primary px-5 float-right">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection