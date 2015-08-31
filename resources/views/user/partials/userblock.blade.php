<div class="media userblock">
	<a href="#" class="pull-left">
		<img src="" alt="{{ $user->getNameOrUsername() }}" class="media-object">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="#">{{ $user->username }}</a></h4>
		@if ($user->getName())
			<p>{{ $user->getName() }}</p>
		@endif

		@if ($user->location)
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>