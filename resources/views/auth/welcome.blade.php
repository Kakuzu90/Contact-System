@extends("layout.auth")

@section("title")
	Registration Complete | Contact System
@endsection

@section("content")
<div class="card shadow-sm">
	<div class="card-body d-flex justify-content-center align-items-center flex-column">
		<h2 class="mb-4">Thank you for registering</h2>
		<a href="{{ route("contacts.index") }}" class="btn btn-outline-success">Continue</a>
	</div>
</div>
@endsection