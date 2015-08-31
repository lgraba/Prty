@extends('templates.default')

@section('content')
	<div class="row">
		<div class="col-lg-5">
			<h3>{{ $user->username }}'s Profile</h3>
			@include('user.partials.userblock')
			<hr>
		</div>
		<div class="col-lg-4 col-lg-offset-3">


			@if (Auth::user()->hasFriendRequestPending($user))
				<p class="name">Waiting for {{ $user->getFirstNameOrUsername() }} to accept your friend request.</p>
				<hr>
			@elseif (Auth::useR()->hasFriendRequestReceived($user))
				<a class="btn btn-primary" href="#">Accept Friend Request</a>
				<hr>
			@elseif (Auth::user()->isFriendsWith($user))
				<p class="name">You and {{ $user->getFirstNameOrUsername() }} are friends!</p>
				<hr>
			@else
				<a href="#" class="btn btn-primary">Add Friend</a>
				<hr>
			@endif



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