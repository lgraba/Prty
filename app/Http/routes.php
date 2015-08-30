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

/**
 * Home
 */
// Set up a get route for home page - See HomeController.php, method index()
Route::get('/', [
	'uses' => '\Prty\Http\Controllers\HomeController@index',
	'as' => 'home',
]);

/**
 * Authentication
 */
// Set up a get route for signup page - See AuthController.php, method getSignup()
Route::get('/signup', [
	'uses' => '\Prty\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup',
]);
// Set up a post route for signup form handling - See AuthController.php, method postSignup()
Route::post('/signup', [
	'uses' => '\Prty\Http\Controllers\AuthController@postSignup',
]);


/**
 * Testing
 */
// Test route for alerts - travel to prty.io/alert to see it in action
Route::get('/alert', function () {
	return redirect()->route('home')->with('info', 'This is a test alert!');
});