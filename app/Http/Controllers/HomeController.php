<?php

// HomeController.php
// Provide HomeController class for index page

namespace Prty\Http\Controllers;

class HomeController extends Controller
{
	// Return view for index/Home Page
	public function index()
	{
		return view('home');
	}
}