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
</head>
<body>

	<div class="vh-100 d-flex justify-content-center align-items-center bg-light">
		<div class="col-xl-4 col-lg-5 col-sm-8 col-11">
			@yield("content")
		</div>
	</div>
	
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>