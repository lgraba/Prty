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
 * Assets Route
 */
// For inclusion of assets in link tags (CSS, JS, etc.) - No related controller
Route::get('/assets', [
	'as' => 'assets',
]);

/**
 * Authentication Routes
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
 * Search Routes
 */
// Set up a get route for Search (for Authenticated user) - See SearchController.php, method getResults()
Route::get('/search', [
	'uses' => '\Prty\Http\Controllers\SearchController@getResults',
	'as' => 'search.results',
]);

/**
 * User Profile Routes
 */
// Set up get route for User Profile - See ProfileController.php, method getProfile()
Route::get('/user/{username}', [
	'uses' => '\Prty\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile.index',
]);
// Set up get route for User Profile Edit page - see ProfileController.php, method getEdit()
Route::get('/profile/edit', [
	'uses' => '\Prty\Http\Controllers\ProfileController@getEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],
]);
// Set up post route for User Profile Edit page - see ProfileController.php, method postEdit()
Route::post('/profile/edit', [
	'uses' => '\Prty\Http\Controllers\ProfileController@postEdit',
	'middleware' => ['auth'],
]);

/**
 * Friends Routes
 */
// Set up a get route for Friend Index - see FriendController.php, method getIndex()
Route::get('/friends', [
	'uses' => '\Prty\Http\Controllers\FriendController@getIndex',
	'as' => 'friends.index',
	'middleware' => ['auth'],
]);
// Set up a get route for Add Friend - see FriendController.php, method getAdd()
Route::get('/friends/add/{username}', [
	'uses' => '\Prty\Http\Controllers\FriendController@getAdd',
	'as' => 'friend.add',
	'middleware' => ['auth'],
]);
// Set up a get route for accepting friend request - see FriendController.php, method getAccept()
Route::get('/friends/accept/{username}', [
	'uses' => '\Prty\Http\Controllers\FriendController@getAccept',
	'as' => 'friend.accept',
	'middleware' => ['auth'],
]);

/**
 * Status Routes
 */
// Set up a post route for making a status - see StatusController.php, method postStatus()
Route::post('/status', [
	'uses' => '\Prty\Http\Controllers\StatusController@postStatus',
	'as' => 'status.post',
	'middleware' => ['auth'],
]);

/**
 * Testing
 */
// Test route for alerts - travel to prty.io/alert to see it in action
Route::get('/alert', function () {
	return redirect()->route('home')->with('info', 'This is a test alert!');
});