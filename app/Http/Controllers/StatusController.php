<?php

// StatusController.php
// Provide SearchController for navbar search box

namespace Prty\Http\Controllers;

// For our User object
use Prty\Models\User\User;
// For Request object
use Illuminate\Http\Request;
// For Auth
use Auth;

class StatusController extends Controller
{
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
}