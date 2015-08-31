<?php

// SearchController.php
// Provide SearchController for navbar search box

namespace Prty\Http\Controllers;

// For our DB query
use DB;
// For our Users object
use Prty\Models\User\User;
// For Request object
use Illuminate\Http\Request;

class SearchController extends Controller
{
	// Grab search results for $request
	public function getResults(Request $request)
	{
		// Query request variable
		$query = $request->input('query');

		// If no query, redirect to home
		if(!$query) {
			return redirect()->route('home');
		}

		// Set users with raw DB LIKE query with name or username
		$users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
			->orWhere('username', 'LIKE', "%{$query}%")
			->get();

		// Search Results view with users passed through to it
		return view('search.results')->with('users', $users);
	}
}