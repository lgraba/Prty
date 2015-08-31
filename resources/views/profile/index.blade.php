@extends('templates.default')

@section('content')
	<h3>{{ $user->username }}'s Profile</h3>
	<div class="row">
		<div class="col-lg-5">
			@include('user.partials.userblock')
			<hr>
		</div>
		<div class="col-lg-4 col-lg-offset-3">
			Here we'll have some friends listed along with any friend requests!
		</div>
	</div>
@stop