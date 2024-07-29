<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>
		@yield('title')
	</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lumen/bootstrap.min.css">
	<style>
		.pagination {
				display: flex;
				list-style: none;
				margin-top: 10px;
				padding: 0;
		}
		.pagination li {
				margin: 0 5px;
		}
		.pagination li a {
				text-decoration: none;
				padding: 5px 10px;
				border: 1px solid #ccc;
		}
		.pagination li a.active {
				background-color: #007bff;
				color: white;
		}

	</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">Contact System</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#"> {{ Auth::user()->name }}
						<span class="sr-only">(current)</span>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav my-2 my-lg-0">
				<li class="nav-item {{ Helper::isActive('contacts.create') ? 'active' : null }}">
					<a class="nav-link" href="{{ route("contacts.create") }}">
						Add Contact
					</a>
				</li>
				<li class="nav-item {{ Helper::isActive('contacts.index') ? 'active' : null }}">
					<a class="nav-link" href="{{ route("contacts.index") }}">
						Contacts
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route("logout") }}">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>

	@yield('content')
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

	@yield('script')
</body>
</html>