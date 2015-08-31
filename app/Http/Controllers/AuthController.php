<?php

// AuthController.php
// Provide AuthController class for Authentication stuff

namespace Prty\Http\Controllers;

// For User model
use Prty\Models\User\User;
// For type Request
use Illuminate\Http\Request;
// For Authentication upon Sign In
use Auth;

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

		// Redirect user to Sign In with flash message
		return redirect()
			->route('auth.signin')
			->with('info', 'Your account has been created. Grab a cold beer and Sign In - It\'s time to party!');
	}

	// For get request to the Sign In page
	public function getSignin()
	{
		return view('auth.signin');
	}

	// For post request from Sign In form page
	public function postSignin(Request $request)
	{
		// Validation via Laravel
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required',
		]);

		// Attempt to Sign the user in with username
        if (!Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $request->has('remember'))) {
        	// Attempt to Sign the user in with Email
	        if (!Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')], $request->has('remember'))) {
	        	// Redirect back to Sign In page if unable to authenticate user
	        	return redirect()
	            	->back()
	            	->with('danger', 'I can\'t let you into the party. Please check your credentials below... and show up with some girls next time.')
	            	->with('username', $request->input('username'));
        	}
        }
        

        // Redirect user home after successful authentication
        return redirect()
        	->route('home')
        	->with('info', 'You are now signed in and ready to party! Cups are $5.');

	}

	// For sign out
	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home')->with('info', 'You\'re leaving the party already, man? Alright, well you\'re signed out for now. Drive safely!');
	}
}