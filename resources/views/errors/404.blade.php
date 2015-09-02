<!-- Home Page -->

@extends('templates.default')

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<span class="top-title"><h1>404 Prty Not Found</h1></span>
			<p>Did you get the wrong address?</p>
			<a href="{{ route('home') }}">Here's the party!</a>
		</div>
	</div>
@stop