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
	// Adding, accepting, and showing friends
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();
		return view('friends.index')
			->with('friends', $friends)
			->with('requests', $requests);
	}
}