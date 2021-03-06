<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created', 'deleted'];

    protected static function boot()
    {
        parent::boot();

        /*static::created(function ($task) {
            $task->project->recordActivity('created_task');*/

            /*Activity::create([
                'project_id' => $task->project->id,
                'description' => 'created_task'
            ]);*/
        /*});*/

        /*static::deleted(function ($task) {
            $task->project->recordActivity('deleted_task');
        });*/

        /*static::updated(function ($task) {
            if (! $task->completed) return;

            $task->project->recordActivity('updated_task');*/
            /*Activity::create([
                'project_id' => $task->project->id,
                'description' => 'updated_task'
            ]);*/
       /* });*/
    }

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incomplete_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
