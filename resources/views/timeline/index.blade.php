@extends('templates.default')

@section('content')

	<div class="row">
		<div class="col-lg-6">
			<form action="{{ route('status.post') }}" role="form" method="post">
				<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
					<textarea class="form-control" name="status" id="status" rows="2" placeholder="What's up, {{ Auth::user()->getFirstNameOrUsername() }}?">{{ Request::old('status') ?: '' }}</textarea>
					@if ($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
					@endif
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
			@if (!$statuses->count())
				<p>No statuses in your timeline, yet!</p>
			@else
				@foreach ($statuses as $status)
					<div class="row">
						<div class="col-lg-12">
							@include('timeline.partials.statusblock')
						</div>
					</div>
				@endforeach

				{!!  $statuses->render() !!}

			@endif
		</div>
	</div>

@stop