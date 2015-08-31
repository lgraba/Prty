<?php

// ProfileController.php
// Provide Profle functionality

namespace Prty\Http\Controllers;

// For our Users object
use Prty\Models\User\User;
// For Request object
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function getProfile($username)
	{
		// Grab user matching the passed username
		$user = User::where('username', $username)->first();
		// Check if we were able to grab a user
		if (!$user) {
			abort(404);
		}
		// Return Profile Index View
		return view('profile.index')
			->with('user', $user);
	}
}