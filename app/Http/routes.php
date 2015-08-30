<?php

// routes.php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Set up a route for home page - See HomeController.php, method index()
Route::get('/', [
	'uses' => '\Prty\Http\Controllers\HomeController@index',
	'as' => 'home',
]);

// Test route for alerts!
// Travel to prty.io/alert to see it in action
Route::get('/alert', function () {
	return redirect()->route('home')->with('info', 'This is a test alert!');
});