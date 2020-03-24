<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        /*if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }*/

        $this->authorize('update', $project);

        request()->validate([
            'body' => 'required'
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        /*echo request()->has('completed');*/

        /*if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }*/

        // gotta update the test to fail using the above an
        // then make it pass using the below.
        if (auth()->user()->isNot($task->project->owner)) {
            abort(403);
        }

        /*$this->authorize('update', $project);*/

        request()->validate([
            'body' => 'required'
        ]);

        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed')
        ]);

        return redirect($project->path());
    }
}
