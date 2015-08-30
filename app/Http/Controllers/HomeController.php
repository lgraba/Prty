<?php

// HomeController.php
// Provide HomeController class for index page

namespace Prty\Http\Controllers;

class HomeController extends Controller
{
	public function index()
	{
		return view('home');
	}
}