<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Prty</title>

			<!-- Latest compiled and minified Bootstrap CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		</head>
	<body>

		<!-- Throw in the navigation -->
		@include('templates.partials.navigation')

		<!-- Got some main content here -->
		<div class="container">
			@yield('content')
		</div>

	</body>
</html>