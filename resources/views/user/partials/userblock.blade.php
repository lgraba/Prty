<div class="media userblock">
	<a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
		<img class="media-object" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNameOrUsername() }}">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->username }}</a></h4>
		<div class="user-info">
			<p>
				@if ($user->getName())
					<span class="name">{{ $user->getName() }}</span>
				@endif

				@if ($user->location)
					<span class="location">{{ $user->location }}</span>
				@endif
			</p>
		</div>
	</div>
</div>