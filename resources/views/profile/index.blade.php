@extends('templates.default')

@section('content')
	<h3>{{ $user->username }}'s Profile</h3>
	<div class="row">
		<div class="col-lg-5">
			@include('user.partials.userblock')
			<hr>
		</div>
		<div class="col-lg-4 col-lg-offset-3">
			<h4>{{ $user->getFirstNameOrUsername() }}'s Friends</h4>

			@if (!$user->friends()->count())
				<p>
					@if ($user == Auth::user())
						You have no friends. Find some people to talk with!
					@else
						{{ $user->getFirstNameOrUsername() }} has no friends :-( Be his friend?
					@endif
				</p>
			@else
				@foreach ($user->friends() as $user)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
	</div>
@stop