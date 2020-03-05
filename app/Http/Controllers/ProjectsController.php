<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        /*$projects = Project::all();*/

        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        $validatedAttributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        /*$validatedAttributes['owner_id'] = auth()->id();

        Project::create($validatedAttributes);*/

        auth()->user()->projects()->create($validatedAttributes);

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        /*$project = Project::findOrFail(request('project'));*/

        /*if (auth()->id() !== (int) $project->owner_id) {
            abort(403);
        }*/

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }
}