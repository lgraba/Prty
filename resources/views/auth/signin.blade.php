<!-- Signup Page -->

@extends('templates.default')

@section('content')

	<div class="row">
		<div class="col-lg-6">
			<h3>Sign In to the Prty!</h3>
			<p>The keg is tapped, people are starting to show up, and the block is HOT. Where you at?</p>
			
			<!-- Sign In Form -->
			<form class="form-vertical" role="form" method="post" action="{{ route('auth.signin') }}">

				<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label class="control-label" for="username">Username or Email</label>
					<input class="form-control" type="text" name="username" id="username" placeholder="username/email" value="{{ Request::old('username') ?: Session::get('username') }}">
					@if ($errors->has('username'))
						<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label class="control-label" for="password">Password</label>
					<input class="form-control" type="password" name="password" id="password">
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="checkbox">
					<label for="remember">
						<input type="checkbox" name="remember" id="remember"> Remember Me
					</label>
				</div>

				<div class="form-group">
					<button class="btn btn-default" type="submit">Sign In</button>
				</div>

				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{ Session::token() }}">

			</form>

		</div>	
	</div>

@stop