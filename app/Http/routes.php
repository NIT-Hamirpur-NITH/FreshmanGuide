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
    return view('link');
});
Route::get('/link2.html', function(){
    return view('link2');
});
// Route for the details page
Route::get('/details', function() {
    // this page will contain details about some specific link so
    // we'll have to write some logic for this route later but
    // right now it's just this.
    return view('details');
});
