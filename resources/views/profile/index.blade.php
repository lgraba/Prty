@extends('templates.default')

@section('content')
	<div class="row">
		<div class="col-lg-5">
			<h3>{{ $user->username }}'s Profile</h3>
			@include('user.partials.userblock')
			<hr>

			<div class="row">
				<div class="col-lg-12 white-bg">
					<!-- Timeline statuses and replies -->
					@if (!$statuses->count())
						<p>{{ $user->getFirstNameOrUsername() }} hasn't posted anything, yet!</p>
					@else
						@foreach ($statuses as $status)
							<div class="row">
								<div class="col-lg-12">
									@include('timeline.partials.statusblock')
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>

		</div>
		<div class="col-lg-4 col-lg-offset-3">


			@if (Auth::user()->hasFriendRequestPending($user))
				<p class="name">Waiting for {{ $user->getFirstNameOrUsername() }} to accept your friend request.</p>
				<hr>
			@elseif (Auth::user()->hasFriendRequestReceived($user))
				<a href="{{ route('friend.accept', ['username' => $user->username]) }}">
					<button type="button" class="btn btn-primary">
						<span class="glyphicon glyphicon-ok" aria-hidden="true" alt="Accept Friend Request"></span> Accept Friend Request
					</button>
				</a>
				<hr>
			@elseif (Auth::user()->isFriendsWith($user))
				<p class="name"><span class="glyphicon glyphicon-heart-empty"></span> You and {{ $user->getFirstNameOrUsername() }} are friends!</p>
				<hr>
			@elseif (Auth::user() != $user)
				<a href="{{ route('friend.add', ['username' => $user->username]) }}">
					<button type="button" class="btn btn-primary">
						<span class="glyphicon glyphicon-plus" aria-hidden="true" alt="Add Friend"></span> Add Friend
					</button>
				</a>
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