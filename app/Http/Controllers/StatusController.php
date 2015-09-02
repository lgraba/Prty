<?php

// StatusController.php
// Provide SearchController for navbar search box

namespace Prty\Http\Controllers;

// For our User object
use Prty\Models\User\User;
// Status Model
use Prty\Models\Status\Status;
// For Request object
use Illuminate\Http\Request;
// For Auth
use Auth;

class StatusController extends Controller
{
	// Post a status, which will show on the Timeline
	public function postStatus(Request $request)
	{
		// Validation
		$this->validate($request, [
			'status' => 'required|max:512',
		]);

		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);

		return redirect()->route('home')->with('info', 'Your status has been posted!');
	}

	// Post a status reply, which will show on the Timeline
	public function postReply(Request $request, $statusId)
	{
		// Validation
		$this->validate($request, [
			"reply-{$statusId}" => 'required|max:512',
		], [
			'required' => 'Go ahead and type something if you want to reply!'
		]);

		// Grab the primary status the user is replying to
		$status = Status::notReply()->find($statusId);

		// Check to make sure there is a primary status, redirect to timeline if not
		if (!$status) {
			return redirect()->route('home')->with('danger', 'Could not find primary post to reply to.');
		}

		// Check to make sure the user is replying to a friend's status or their own status
		if (!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
			return redirect()->route('home')->with('danger', 'You can\'t reply to the status of a user you are not friends with!');
		}

		// Create the reply, associated with the authenticated user
		$reply = Status::create([
			'body' => $request->input("reply-{$statusId}"),
		])->user()->associate(Auth::user());

		// Insert reply into status model/database
		$status->replies()->save($reply);

		return redirect()->back()->with('info', 'Your reply has been posted!');

	}

	// Be able to like
	public function getLike($statusId)
	{
		// Get the status by statusId
		$status = Status::find($statusId);

		// Check if there is no status with that id
		if (!$status) {
			return redirect()->route('home')->with('danger', 'Why are you trying to eye something that doesn\'t exist?');
		}

		// Check user making like is friends with the user who owns the status
		if (!Auth::user()->isFriendsWith($status->user)) {
			return redirect()->route('home')->with('danger', 'Why are you trying to eye someone\'s status that you aren\'t friends with?');
		}

		// Check whether they have already like the status with hasLikedStatus
		if (Auth::user()->hasLikedStatus($status)) {
			return redirect()->back()->with('info', 'You have already eyed that status once!');
		}

		// Create the like and save it to current user likes
		$like = $status->likes()->create([]);
		Auth::user()->likes()->save($like);

		return redirect()->back()->with('info', 'You have eyed the status!');
	}
}