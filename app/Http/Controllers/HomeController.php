<?php

// HomeController.php
// Provide HomeController class for index page

namespace Prty\Http\Controllers;
// For Auth
use Auth;

class HomeController extends Controller
{

	// Return view for index/Home Page
	public function index()
	{
		// If the user is authenticated, show Timeline view
		if (Auth::check()) {
			return view('timeline.index');
		} else {
			// Otherwise return standard home view
			return view('home');
		}
	}
}