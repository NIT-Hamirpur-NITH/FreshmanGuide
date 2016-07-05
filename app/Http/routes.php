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
    return view('home', [
        'title' => 'Home',
        'bodyClass' => 'homepage',
    ]);
});

// Routes for sections page
Route::group(['prefix' => 'sections'], function() {
    Route::get('/', 'SectionController@home');
Route::get('/{id}/articles', 'SectionController@articles');
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



// Read the articles
Route::get('/read/{slug}', 'ArticleController@read');

/**
 * Article addition routes
 */

Route::get('/add', 'ArticleController@add');
Route::post('/add', 'ArticleController@create');
Route::get('/edit/{searchid}', 'ArticleController@edit');
Route::post('/save/{searchid}', 'ArticleController@save');
Route::post('/title/{searchid}', 'ArticleController@titleChange');

// handling image uplaods
Route::post('/image/upload', 'ImageController@upload');
Route::post('/image/rotate', 'ImageController@rotate');
Route::post('/image/insert', 'ImageController@insert');
Route::post('/image/onsave', 'ImageController@onsave');


// login to the website
Route::get('/___login__', 'Auth\AuthController@getLogin');
Route::post('/___login__', 'Auth\AuthController@postLogin');

// add the admin things
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {

    Route::get('/', 'AdminController@home');
    Route::get('/articles', 'AdminController@articles');
    Route::get('/publish/{searchid}', 'AdminController@publish');
    Route::get('/unpublish/{searchid}', 'AdminController@unpublish');
    Route::get('/delete/{searchid}', 'AdminController@delete');
    Route::get('/logout', 'AdminController@logout');
    Route::get('/sections', 'AdminController@sections');
    Route::get('/sections/add', 'AdminController@addSection');
    Route::post('/sections/add', 'AdminController@createSection');
    Route::get('/sections/delete/{id}', 'AdminController@deleteSection');
    Route::get('/sections/edit/{id}', 'AdminController@editSection');
    Route::post('/sections/edit/{id}', 'AdminController@updateSection');
    Route::get('/sections/articles/{id}', 'AdminController@listSectionArticles');
    Route::get('/categorize/{searchid}', 'AdminController@categorize');
    Route::post('/categorize/{searchid}', 'AdminController@addCategory');

});

