<?php

// HomeController.php
// Provide HomeController class for index page

namespace Prty\Http\Controllers;
// For Auth
use Auth;
// For Statuses
use Prty\Models\Status\Status;

class HomeController extends Controller
{

	// Return view for index/Home Page
	public function index()
	{
		// If the user is authenticated, show Timeline view
		if (Auth::check()) {

			// Pull in statuses of the authenticated user + the authenticated user's friends
			$statuses = Status::where(function($query) {
				return $query
					->where('user_id', Auth::user()->id)
					->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
			})
			->orderBy('created_at', 'desc')
			->paginate(2);

			// Return timeline view with statuses data attached
			return view('timeline.index')->with('statuses', $statuses);

		} else {
			// Otherwise return standard home view
			return view('home');
		}
	}
}