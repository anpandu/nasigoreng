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
Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['namespace' => 'ORM'], function(){

	Route::resource('post', 'PostController');

	Route::resource('category', 'CategoryController');
	Route::get('category/{id}/posts', 'CategoryController@getPosts');
	
	Route::resource('tag', 'TagController');
	Route::get('tag/{id}/posts', 'TagController@getPosts');

});


Route::group(['namespace' => 'CMS'], function()
{
	Route::get('/', function(){ return redirect('/dashboard');});

	Route::group(['middleware' => 'auth'], function()
	{
		Route::get('/dashboard', 'CMSController@dashboard');

		// Route::get('/project', 'ProjectCMSController@index');
		// Route::get('/project/edit/{id}', 'ProjectCMSController@edit');
		// Route::post('/project/update/{id}', 'ProjectCMSController@update');

		// Route::get('/widget', 'WidgetCMSController@index');
		// Route::get('/widget/edit/{id}', 'WidgetCMSController@edit');
		// Route::post('/widget/update/{id}', 'WidgetCMSController@update');
		// Route::get('/widget/delete/{id}', 'WidgetCMSController@delete');

	});

});