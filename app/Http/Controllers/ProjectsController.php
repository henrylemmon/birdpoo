<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        $validatedAttributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Project::create($validatedAttributes);

        return redirect('/projects');
    }
}
