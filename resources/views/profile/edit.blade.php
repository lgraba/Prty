<!-- Profile Edit Page -->

@extends('templates.default')

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<h3>Change Your Profile Details</h3>
			<form class="form-vertical" role="form" action="{{ route('profile.edit') }}" method="post">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="control-label" for="email">Email Address</label>
							<input class="form-control" type="text" name="email" id="email" placeholder="{{ $user->email }}" value="{{ Request::old('email') ?: $user->email }}">
							@if ($errors->has('email'))
								<span class="help-block">{{ $errors->first('email') }}</span>
							@endif
						</div>
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label class="control-label" for="username">Username</label>
							<input class="form-control" type="text" name="username" id="username" placeholder="{{ $user->username }}" value="{{ Request::old('username') ?: $user->username }}">
							@if ($errors->has('username'))
								<span class="help-block">{{ $errors->first('username') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
							<label class="control-label" for="first_name">First Name</label>
							<input class="form-control" type="text" name="first_name" id="first_name" placeholder="{{ $user->first_name }}" value="{{ Request::old('first_name') ?: $user->first_name }}">
							@if ($errors->has('first_name'))
								<span class="help-block">{{ $errors->first('first_name') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label class="control-label" for="last_name">Last Name</label>
							<input class="form-control" type="text" name="last_name" id="last_name" placeholder="{{ $user->last_name }}" value="{{ Request::old('last_name') ?: $user->last_name }}">
							@if ($errors->has('last_name'))
								<span class="help-block">{{ $errors->first('last_name') }}</span>
							@endif
						</div>
					</div>
				</div>
				<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
					<label class="control-label" for="location">Location</label>
					<input class="form-control" type="text" name="location" id="location" placeholder="{{ $user->location }}" value="{{ Request::old('location') ?: $user->location }}">
					@if ($errors->has('location'))
						<span class="help-block">{{ $errors->first('location') }}</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-default" type="submit">Update Details</button>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>
@stop