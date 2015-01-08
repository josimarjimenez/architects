<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth'), function()
{
	Route::controller('organization', 'OrganizationsController');
	Route::controller('states','ScrumStatesController');
	Route::resource('projects', 'ProjectsController');
	Route::resource('materials', 'MaterialsController');
	Route::resource('teams', 'TeamsController'); 
	Route::resource('issue', 'IssueController');
	Route::resource('iterations', 'IterationsController');
});
 
Route::controller('users', 'UsersController');
Route::get('/', 'UsersController@getLogin');
