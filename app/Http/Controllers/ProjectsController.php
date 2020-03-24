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

    public function show(Project $project)
    {
        /*$project = Project::findOrFail(request('project'));*/

        /*if (auth()->id() !== (int) $project->owner_id) {
            abort(403);
        }*/

        /*if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }*/

        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        /*$validatedAttributes = request()->validate([
            'title' => 'required',
            'description' => 'required|max:75',
            'notes' => 'min:3'
        ]);*/

        /*$validatedAttributes['owner_id'] = auth()->id();

        Project::create($validatedAttributes);*/

        $project = auth()->user()->projects()->create($this->validatedAttributes());

        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        /*if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }*/

        $this->authorize('update', $project);

        /*$validatedAttributes = request()->validate([
            'title' => 'required',
            'description' => 'required|max:75',
            'notes' => 'min:3'
        ]);*/

        $project->update($this->validatedAttributes());

        return redirect($project->path());
    }

    protected function validatedAttributes()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required|max:75',
            'notes' => 'nullable'
        ]);
    }
}
