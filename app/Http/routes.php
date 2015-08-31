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
 * Assets
 */
// For inclusion of assets in link tags (CSS, JS, etc.) - No related controller
Route::get('/assets', [
	'as' => 'assets',
]);

/**
 * Authentication
 */
// Set up a get route for Sign Up page (for guest) - See AuthController.php, method getSignup()
Route::get('/signup', [
	'uses' => '\Prty\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup',
	'middleware' => ['guest'],
]);
// Set up a post route for Sign Up form handling (for guest) - See AuthController.php, method postSignup()
Route::post('/signup', [
	'uses' => '\Prty\Http\Controllers\AuthController@postSignup',
	'middleware' => ['guest'],
]);
// Set up a get route for Sign In page (for guest) - See AuthController.php, method getSignin()
Route::get('/signin', [
	'uses' => '\Prty\Http\Controllers\AuthController@getSignin',
	'as' => 'auth.signin',
	'middleware' => ['guest'],
]);
// Set up a post route for Sign In form handling (for guest) - See AuthController.php, method postSignin()
Route::post('/signin', [
	'uses' => '\Prty\Http\Controllers\AuthController@postSignin',
	'middleware' => ['guest'],
]);
// Set up a post route for Signing Out - See AuthController.php, method postSignout()
Route::get('/signout', [
	'uses' => '\Prty\Http\Controllers\AuthController@getSignout',
	'as' => 'auth.signout',
]);

/**
 * Search
 */
// Set up a get route for Search (for Authenticated user) - See SearchController.php, method getResults()
Route::get('/search', [
	'uses' => '\Prty\Http\Controllers\SearchController@getResults',
	'as' => 'search.results',
]);

/**
 * User Profile
 */
// Set up get route for User Profile - See ProfileController.php, method getProfile()
Route::get('/user/{username}', [
	'uses' => '\Prty\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile.index',
]);


/**
 * Testing
 */
// Test route for alerts - travel to prty.io/alert to see it in action
Route::get('/alert', function () {
	return redirect()->route('home')->with('info', 'This is a test alert!');
});