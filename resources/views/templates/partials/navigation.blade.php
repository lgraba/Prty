<!-- Navigation (Bootstrap) -->

<nav class="navbar navbar-default" role="navigation">
	<div class="container">

		<!-- Brand -->
		<div class="navbar-header">
			<a href="#" class="navbar-brand">Prty</a>
		</div>
		<div class="collapse navbar-collapse">

			<!-- @if (Auth::check()) -->
				<ul class="nav navbar-nav">
					<li><a href="#">Timeline</a></li>
					<li><a href="#">Friends</a></li>
				</ul>

				<!-- Search form -->
				<form action="#" role="search" class="navbar-form navbar-left">
					<div class="form-group">
						<input class="form-control" type="text" name="query" id="query" placeholder="Find someone!">
					</div>
					<button class="btn btn-default" type="submit">Search</button>
				</form>
			<!-- @endif -->

			<ul class="nav navbar-nav navbar-right">

				<!-- @if (Auth::check()) -->
					<li><a href="#">Logan<!-- {{ Auth::user()->getNameOrUsername() }} --></a></li>
					<li><a href="#">Change Profile</a></li>
					<li><a href="#">Sign Out</a></li>
				<!-- @else -->
					<li><a href="#">Sign Up</a></li>
					<li><a href="#">Sign In</a></li>
				<!-- @endif -->
				
			</ul>

		</div>
	</div>
</nav>