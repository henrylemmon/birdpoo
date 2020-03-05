<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects', 'ProjectsController@index')/*->middleware('auth')*/;
    Route::get('/projects/{project}', 'ProjectsController@show')/*->middleware('auth')*/;
    Route::post('/projects', 'ProjectsController@store')/*->middleware('auth')*/;

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
