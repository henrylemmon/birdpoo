<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function invite(User $user)
    {
        // using pivot we attach user to project
        return $this->members()->attach($user);
    }

    public function members()
    {
        // is it true that a project can have many members
        // and also members can have many projects
        // so we need a pivot table
        return $this->belongsToMany(User::class, 'project_members');
    }
}
