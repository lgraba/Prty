<div class="media userblock">
	<a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
		<img class="media-object" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNameOrUsername() }}">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->username }}</a></h4>
		<div class="user-info">
			@if ($user->getName())
				<p>{{ $user->getName() }}</p>
			@endif

			@if ($user->location)
				<p>{{ $user->location }}</p>
			@endif
		</div>
	</div>
</div>