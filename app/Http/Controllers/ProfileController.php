<?php

// ProfileController.php
// Provide Profle functionality

namespace Prty\Http\Controllers;

// For our Users object
use Prty\Models\User\User;
// For Request object
use Illuminate\Http\Request;
// For Auth
use Auth;

class ProfileController extends Controller
{
	// Get the Profile Index
	public function getProfile($username)
	{
		// Grab user matching the passed username
		$user = User::where('username', $username)->first();
		// Check if we were able to grab a user
		if (!$user) {
			abort(404);
		}
		// Return Profile Index View with User Details
		return view('profile.index')
			->with('user', $user);
	}

	// Get the Profile Edit form
	public function getEdit()
	{
		// Set user to currently authenticated user
		$user = Auth::user();
		// Return Profile Edit View with User details
		return view('profile.edit')
			->with('user', $user);
	}

	// POST handling of Profile Edit form
	public function postEdit(Request $request)
	{
		// Set user to currently authenticated user
		$user = Auth::user();
		// Validation with unique exception for currently authenticated user's email and username
		$this->validate($request, [
			'email' => 'required|email|max:255|unique:users,email,'.$user->id,
			'username' => 'required|alpha_dash|max:64|unique:users,username,'.$user->id,
			'first_name' => 'alpha|max:64',
			'first_name' => 'alpha|max:64',
			'location' => 'max:128',
		]);

		// Update profile details in database
		$user->update([
			'email' => $request->input('email'),
			'username' => $request->input('username'),
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'location' => $request->input('location'),
		]);

		// Redirect to Profile with flash message
		return redirect()
			->route('profile.edit')
			->with('info', 'Your profile has been updated.');
	}
}