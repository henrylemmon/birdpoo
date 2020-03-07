<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects', 'ProjectsController@index')/*->middleware('auth')*/;
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{project}', 'ProjectsController@show')/*->middleware('auth')*/;
    Route::post('/projects', 'ProjectsController@store')/*->middleware('auth')*/;

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
