<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects', 'ProjectsController@index');

Route::post('/projects', 'ProjectsController@store');
