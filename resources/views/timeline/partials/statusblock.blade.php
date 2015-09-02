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
				<li>4 days ago</li>
				<li>
					<a href="#">
						<button type="button" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true" alt="Eye It"></span> Eye It
						</button>
					</a>
				</li>
				<li>
					3 <span class="glyphicon glyphicon-eye-open" aria-hidden="true" alt="Eye It"></span>
				</li>
			</ul>

			{{-- <div class="media">
				<a href="#" class="pull-left">
					<img src="#" alt="" class="media-object">
				</a>
				<div class="media-body">
					<h5 class="media-heading"><a href="#">Billy</a></h5>
					<p>This is a response status.</p>
					<ul class="list-inline">
						<li>10 minutes ago</li>
						<li><a href="#">Like</a></li>
						<li>2 Likes</li>
					</ul>
				</div>
			</div> --}}

			<form role="form" action="#" method="post">
				<div class="form-group">
					<textarea class="form-control" name="reply-1" id="reply-1" rows="2" placeholder="Reply to this status!"></textarea>
				</div>
				<input class="btn btn-default btn-sm" type="submit" value="Reply">
			</form>

		</div>
	</div>
</div>