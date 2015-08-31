<?php

// FriendController.php
// Provide Friend display and requesting for an authenticated user

namespace Prty\Http\Controllers;

// For our Users object
use Prty\Models\User\User;
// For Request object
use Illuminate\Http\Request;
// For Auth
use Auth;

class FriendController extends Controller
{
	// Showing friends
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();

		return view('friends.index')
			->with('friends', $friends)
			->with('requests', $requests);
	}

	// Add friend
	public function getAdd($username)
	{
		// Select user based on the username
		$user = User::where('username', $username)->first();

		// If no user returned via username, redirect
		if (!$user) {
			return redirect()
				->route('home')
				->with('danger', 'That user couldn\'t be found. Try using the buttons!');
		}

		// Make sure we're not trying to add ourselves
		if (Auth::user()->id === $user->id) {
			return redirect()
				->route('profile.index', ['username' => $username])
				->with('danger', 'You can\'t add yourself as a friend.');
		}

		// If a friend request is pending either way, redirect
		if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
			return redirect()
				->route('profile.index', ['username' => $username])
				->with('info', 'Your friend request to ' . $user->getFirstNameOrUsername() . ' is already pending.');
		}

		// If we are already friends, redirect
		if (Auth::user()->isFriendsWith($user)) {
			return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'You are already friends with ' . $user->getFirstNameOrUsername() . '!');
		}

		// Add the user to friend list
		Auth::user()->addFriend($user);

		// Redirect
		return redirect()
			->route('profile.index', ['username' => $username])
			->with('info', 'Friend request sent to ' . $user->getFirstNameOrUsername() . '!');
	}

	// Accept friend request
	public function getAccept($username)
	{
		// Select user based on the username
		$user = User::where('username', $username)->first();

		// If no user returned via username, redirect
		if (!$user) {
			return redirect()
				->route('home')
				->with('danger', 'That user couldn\'t be found. Try using the buttons!');
		}

		// Make sure we're not trying to add ourselves
		if (Auth::user()->id === $user->id) {
			return redirect()
				->route('profile.index', ['username' => $username])
				->with('danger', 'You can\'t add yourself as a friend.');
		}

		// If we are already friends, redirect
		if (Auth::user()->isFriendsWith($user)) {
			return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'You are already friends with ' . $user->getFirstNameOrUsername() . '!');
		}
		// Make sure there is a pending friend request
		if (!Auth::user()->hasFriendRequestReceived($user)) {
			return redirect()
				->route('home')
				->with('danger', 'You have not received a friend request from ' . $user->getFirstNameOrUsername() . ', yet.');
		}

		// Actually accept the friend request
		Auth::user()->acceptFriendRequest($user);

		// Redirect
		return redirect()
			->route('profile.index', ['username' => $username])
			->with('info', 'Friend request from '. $user->getFirstNameOrUsername() . ' accepted!');
	}

}