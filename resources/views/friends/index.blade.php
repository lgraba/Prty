<!-- Friends Page -->

@extends('templates.default')

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<span class="top-title"><h2>Your Friends</h2></span>
			@if (!$friends->count())
				<p>You have no friends. There are some hot people available via the search box above...</p>
			@else
				@foreach ($friends as $user)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
		<div class="col-lg-6">
			<span class="top-title"><h2>Friend Requests</h2></span>
				@if (!$requests->count())
					<p>You have no friend requests. Request some friends of your own?</p>
				@else
					@foreach ($requests as $user)
						@include('user.partials.userblock')
					@endforeach
				@endif
		</div>
	</div>
@stop