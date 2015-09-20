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

/*Route::get('/', function()
{
	return View::make('hello');
});*/


Route::any('/','EmployeesController@index');
Route::get('employee', ['as' => 'employees.index', 'uses' => 'EmployeesController@index']);

Route::any('employee/create','EmployeesController@create');
Route::any('employee/create', ['as' => 'employees.create', 'uses' => 'EmployeesController@create' ]);


Route::any('employee/store', ['as' => 'employees.store', 'uses' => 'EmployeesController@store' ]);




//Gallery
Route::any('employee/gallery', [ 'as' => 'employees.gallery', 'uses' => 'EmployeesController@gallery' ]);


Route::get('/uploads', function(){return View::make('employee.fileupload'); });
Route::post('employee/upload', [ 'as' => 'employees.upload', 'uses' => 'EmployeesController@upload' ]);
Route::post('employee/massDelete', [ 'as' => 'employees.massDelete', 'uses' => 'EmployeesController@massDelete' ]);



Route::any('employee/edit/{id}', ['as' => 'employees.edit', 'uses' => 'EmployeesController@edit' ]);

Route::get('employee/show/{id}', [ 'as' => 'employees.show', 'uses' => 'EmployeesController@show' ]);

Route::any('employee/destroy/{id}', ['as' => 'employees.destroy', 'uses' => 'EmployeesController@destroy' ]);
