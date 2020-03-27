<?php

namespace Tests\Feature;

use App\Task;
use App\Project;
use Tests\TestCase;
use Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks')
            ->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Testis lo taskisdermis'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Testis lo taskisdermis']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        // this test must be updated to fail with the current policy in ProjectTasksController update function
        /*$this->signIn();*/

        /*$project = factory(Project::class)->create();
        $task = $project->addTask('Testum Updatus');*/

        $project1 = app(ProjectFactory::class)->create();
        $project2 = app(ProjectFactory::class)->withTasks(1)->create();

        $this->actingAs($project1->owner)
            ->patch($project1->path() . '/tasks/' . $project2->tasks->first()->id, ['body' => 'Testum Updatus Updated'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Testum Updatus Updated']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        /*$this->signIn();*/

        /*$project = factory(Project::class)->create(['owner_id' => auth()->id()]);*/

        /*$project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );*/

        $project = app(ProjectFactory::class)->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Testis lo taskisdermis']);

        $this->get($project->path())
            ->assertSee('Testis lo taskisdermis');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = app(ProjectFactory::class)
            ->ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

        /*$project = factory(Project::class)->create(['owner_id' => auth()->id()]);*/

       /* $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $task = $project->addTask('Testo Taskola');*/

        $this->patch($project->tasks->first()->path(), [
            'body' => 'Testo Taskola Changeo'/*,
            'completed' => true*/
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Testo Taskola Changeo'/*,
            'completed' => true*/
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = app(ProjectFactory::class)
            ->ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

        /*$project = factory(Project::class)->create(['owner_id' => auth()->id()]);*/

        /* $project = auth()->user()->projects()->create(
             factory(Project::class)->raw()
         );

         $task = $project->addTask('Testo Taskola');*/

        $this->patch($project->tasks->first()->path(), [
            'body' => 'Testo Taskola Changeo',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Testo Taskola Changeo',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete()
    {
        $project = app(ProjectFactory::class)
            ->ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

        $this->patch($project->tasks->first()->path(), [
            'body' => 'Testo Taskola Changeo',
            'completed' => true
        ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'Testo Taskola Changeo again',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Testo Taskola Changeo again',
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        /*$this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );*/

        $project = app(ProjectFactory::class)
            ->create();

        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
