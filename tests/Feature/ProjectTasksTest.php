<?php

namespace Tests\Feature;

use App\Task;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        /*$project = factory(Project::class)->create(['owner_id' => auth()->id()]);*/

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $this->post($project->path() . '/tasks', ['body' => 'Testis lo taskisdermis']);

        $this->get($project->path())
            ->assertSee('Testis lo taskisdermis');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
