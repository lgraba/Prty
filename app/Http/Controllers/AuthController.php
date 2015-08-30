<?php

// AuthController.php
// Provide AuthController class for Authentication stuff

namespace Prty\Http\Controllers;

// For User model
use Prty\Models\User\User;
// For type Request
use Illuminate\Http\Request;

class AuthController extends Controller
{
	// For get request to the Sign Up page
	public function getSignup()
	{
		return view('auth.signup');
	}

	// For post request from Sign Up form page
	public function postSignup(Request $request)
	{
		// Validation via Laravel
		$this->validate($request, [
			'email' => 'required|unique:users|email|max:255',
			'username' => 'required|unique:users|alpha_dash|max:64',
			'password' => 'required|min:6|confirmed',
		]);

		// Create User record in database
		User::create([
			'email' => $request->input('email'),
			'username' => $request->input('username'),
			'password' => bcrypt($request->input('password')),
		]);

		// Redirect user to home with flash message
		return redirect()
			->route('home')
			->with('info', 'Your account has been created. Grab a cold beer and your friends - It\'s time to party!');
	}
}