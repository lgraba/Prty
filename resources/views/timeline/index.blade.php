@extends('templates.default')

@section('content')

	<div class="row">
		<div class="col-lg-6">
			<form action="#" role="form" method="post">
				<div class="form-group">
					<textarea class="form-control" name="status" id="status" rows="2" placeholder="What's up, {{ Auth::user()->getFirstNameOrUsername() }}?"></textarea>
				</div>
				<button class="btn btn-default" type="submit">Tell 'Em!</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-5">
			<!-- Timeline statuses and replies -->
		</div>
	</div>

@stop