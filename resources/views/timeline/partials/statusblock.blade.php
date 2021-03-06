<div class="media">
	<a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
		<img class="media-object" src="{{ $status->user->getAvatarUrl(32) }}" alt="{{ $status->user->getNameOrUsername() }}">
	</a>
	<div class="media-body">
		<ul class="list-inline">
			<li><h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->username }}</a></h4></li>
			<li class="name">{{ $status->user->getName() }}</li>
			<li>{{ $status->user->location }}</li>
		</ul>
		
		<div class="status-info">
			<p>
				{{ $status->body }}
			</p>
			<ul class="list-inline">
				<li>{{ $status->created_at->diffForHumans() }}</li>
				@if ($status->user->id !== Auth::user()->id && !Auth::user()->hasLikedStatus($status) && Auth::user()->isFriendsWith($status->user))
					<li>
						<a href="{{ route('status.like', ['statusId' => $status->id]) }}">
							<button type="button" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true" alt="Eye It"></span> Eye It
							</button>
						</a>
					</li>
				@endif
				<li>
					<span class="glyphicon glyphicon-eye-open" aria-hidden="true" alt="Eye It"></span> {{ $status->likes->count() }}
				</li>
			</ul>

			@foreach ($status->replies as $reply)

				<div class="media">
					<a href="{{ route('profile.index', ['username' => $reply->user->username]) }}" class="pull-left">
						<img src="{{ $reply->user->getAvatarUrl(32) }}" alt="{{ $reply->user->getNameOrUsername() }}" class="media-object">
					</a>
					<div class="media-body">
						<ul class="list-inline">
							<li><h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->username }}</a></h4></li>
							<li class="name">{{ $reply->user->getName() }}</li>
							<li>{{ $reply->user->location }}</li>
						</ul>

						<p>{{ $reply->body }}</p>

						<ul class="list-inline">
							<li>{{ $reply->created_at->diffForHumans() }}</li>
							@if ($reply->user->id !== Auth::user()->id && !Auth::user()->hasLikedStatus($reply) && Auth::user()->isFriendsWith($reply->user))
								<li>
									<a href="{{ route('status.like', ['statusId' => $reply->id]) }}">
										<button type="button" class="btn btn-default btn-sm">
											<span class="glyphicon glyphicon-eye-open" aria-hidden="true" alt="Eye It"></span> Eye It
										</button>
									</a>
								</li>
							@endif
							<li>
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true" alt="Eye It"></span> {{ $reply->likes->count() }}
							</li>
						</ul>

					</div>
				</div>

			@endforeach
			
			@if (Auth::user()->isFriendsWith($status->user) || Auth::user() == $status->user)
				<form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
					<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error' : '' }}">
						<textarea class="form-control" name="reply-{{ $status->id }}" id="reply-{{ $status->id }}" rows="2" placeholder="Reply to this status!">{{ trim(Request::old("reply-{$status->id}")) ?: '' }}</textarea>
						@if ($errors->has("reply-{$status->id}"))
							<span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
						@endif
					</div>
					<input class="btn btn-default btn-sm" type="submit" value="Reply">
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>
			@endif

		</div>
	</div>
</div>