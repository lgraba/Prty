<!-- Search Results Page -->

@extends('templates.default')

@section('content')

		<div class="row">
			<div class="col-lg-6">
				<h3>Search Results for '{{ Request::input('query') }}'</h3>
				@if (!$users->count())
					<p>No results found!</p>		
				@else
					<!-- Throw in the userblocks -->
					@foreach ($users as $user)
						
						@include('user.partials.userblock')

					@endforeach
				@endif
			</div>
		</div>
	
@stop