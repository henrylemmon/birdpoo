<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function guests_may_not_manage_projects()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects')
            ->assertRedirect('login');

        $this->get($project->path())
            ->assertRedirect('login');

        $this->get('/projects/create')
            ->assertRedirect('login');

        $this->get($project->path() . '/edit')
            ->assertRedirect('login');

        $this->post('/projects', $project->toArray())
            ->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();

        $this->get('/projects/create')
            ->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(3),
            'notes' => 'General notes here.'
        ];

        $response = $this->post('/projects', $attributes);
        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        /*$this->signIn();

        $project = factory(Project::class)->create(
            ['owner_id' => auth()->id()]
        );*/

        $project = ProjectFactory::ownedBy($this->signIn())->create();

        $this->patch($project->path(), $attributes =  [
            'title' => 'Changed',
            'description' => 'Changed',
            'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->get($project->path() . '/edit')
            ->assertStatus(200);

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'notes' => 'Lets add some general notes'
            ]);

        $this->get($project->path())
            ->assertSee($attributes['notes']);

    }

    /** @test */
    public function a_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->patch($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        /*$this->signIn();

        $project = factory(Project::class)->create(
            ['owner_id' => auth()->id()]
        );*/

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee(\STR::limit($project->description, 75));
    }

    /** @test */
    public function a_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->get($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $attributes)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $attributes)
            ->assertSessionHasErrors('description');
    }
}
