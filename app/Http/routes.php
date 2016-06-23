<?php

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

// Route for the landing page
Route::get('/', function () {
    return view('landing');
});

// Route for the about page
Route::get('/about', function() {
    return view('about');
});

// Route for the links page
Route::get('/links', function() {
    return view('links');
});

// Route for the details page
Route::get('/details', function() {
    // this page will contain details about some specific link so
    // we'll have to write some logic for this route later but
    // right now it's just this.
    return view('details');
});


/**
 * Facebook authentication routes
 */
Route::get('/auth/fb/login', 'SocialAuthController@login');
Route::get('/auth/fb/redirect', 'SocialAuthController@redirect');
Route::get('/auth/fb/callback', 'SocialAuthController@callback');
Route::get('/auth/fb/logout', 'SocialAuthController@logout');

/**
 * Article addition routes
 */

Route::get('/add', 'ArticleController@create');
Route::get('/edit/{searchid}', 'ArticleController@edit');
Route::post('/save/{searchid}', 'ArticleController@save');

// handling image uplaods
Route::post('/image/upload', 'ImageController@upload');
Route::post('/image/rotate', 'ImageController@rotate');
Route::post('/image/insert', 'ImageController@insert');
Route::post('/image/onsave', 'ImageController@onsave');