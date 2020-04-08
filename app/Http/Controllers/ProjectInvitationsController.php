<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectInvitationsRequest;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationsRequest $request)
    {
        /*$this->authorize('update', $project);

        request()->validate([
            'email' => ['required', 'exists:users,email']
        ], [
            'email.exists' => 'The user you are inviting must have a birdshit account.'
        ]);*/

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
