<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Prty</title>

			<!-- Latest compiled and minified Bootstrap CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

			<!-- Google Fonts -->
			<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

			<!-- My CSS -->
			<link rel="stylesheet" href="{{ route('assets') }}/css/app.css">

		</head>
	<body>

		<!-- Throw in the navigation -->
		@include('templates.partials.navigation')

		<div class="container">
			<!-- Got yer user alerts right here -->
			@include('templates.partials.alerts')
			<!-- Got some main content here -->
			@yield('content')
		</div>

	</body>
</html>