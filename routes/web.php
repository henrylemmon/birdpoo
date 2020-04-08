<?php

/*\App\Project::created(function ($project) {
    \App\Activity::create([
        'project_id' => $project->id,
        'description' => 'created'
    ]);
});

\App\Project::updated(function ($project) {
    \App\Activity::create([
        'project_id' => $project->id,
        'description' => 'updated'
    ]);
});*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    /*Route::get('/projects', 'ProjectsController@index')->middleware('auth');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::get('/projects/{project}', 'ProjectsController@show')->middleware('auth');
    Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    Route::patch('/projects/{project}', 'ProjectsController@update');
    Route::post('/projects', 'ProjectsController@store')->middleware('auth');
    Route::delete('/projects/{project}', 'ProjectsController@destroy');*/
    Route::resource('projects', 'ProjectsController');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');

    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
