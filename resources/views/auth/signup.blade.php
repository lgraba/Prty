<!-- Signup Page -->

@extends('templates.default')

@section('content')

	<h3>Sign Up for the Prty!</h3>

	<div class="row">
		<div class="col-lg-6">
			
			<p>A good party has exquisitely interesting people in attendance. Make sure you're there to uniquely add your own to the gathering!</p>
			
			<!-- Sign Up Form -->
			<form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}">

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label class="control-label" for="email">Email Address</label>
					<input class="form-control" type="text" name="email" id="email" placeholder="your@email.com" value="{{ Request::old('email') ?: '' }}">
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label lass="control-label" for="username">Username</label>
					<input class="form-control" type="text" name="username" id="username" placeholder="username" value="{{ Request::old('username') ?: '' }}">
					@if ($errors->has('username'))
						<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label lass="control-label" for="password">Password</label>
					<input class="form-control" type="password" name="password" id="password">
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<label lass="control-label" for="password_confirmation">Confirm Password</label>
					<input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
					@if ($errors->has('password_confirmation'))
						<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
					@endif
				</div>
				<div class="form-group">
					<button class="btn btn-default" type="submit">Sign Up</button>
				</div>

				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ Session::token() }}">

			</form>

		</div>	
	</div>

@stop