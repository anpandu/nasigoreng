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


Route::get('/', 'WelcomeController@index');
Route::get('home', function(){ return redirect('/cms/dashboard');});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['namespace' => 'ORM'], function(){

	Route::resource('post', 'PostController');
	Route::get('post/category/{slug}', 'PostController@category');

	Route::resource('category', 'CategoryController');
	Route::get('category/{id}/posts', 'CategoryController@getPosts');
	
	Route::resource('tag', 'TagController');
	Route::get('tag/{id}/posts', 'TagController@getPosts');

});


Route::group(['namespace' => 'CMS', 'prefix' => 'cms'], function()
{
	Route::get('/', function(){ return redirect('/dashboard');});

	Route::group(['middleware' => 'auth'], function()
	{
		Route::get('/dashboard', 'CMSController@dashboard');

		Route::get('/post', 'PostCMSController@index');
		Route::get('/post/category/{slug}', 'PostCMSController@category');
		Route::get('/post/edit/{id}', 'PostCMSController@edit');
		Route::post('/post/update/{id}', 'PostCMSController@update');

		Route::get('/category', 'CategoryCMSController@index');
		Route::get('/category/edit/{id}', 'CategoryCMSController@edit');
		Route::post('/category/update/{id}', 'CategoryCMSController@update');

		Route::get('/tag', 'TagCMSController@index');
		Route::get('/tag/edit/{id}', 'TagCMSController@edit');
		Route::post('/tag/update/{id}', 'TagCMSController@update');

	});

});