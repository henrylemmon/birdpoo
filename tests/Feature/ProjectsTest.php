<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function guests_may_not_create_projects()
    {
        $attributes = factory(Project::class)->raw();

        $this->post('/projects', $attributes)
            ->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_projects()
    {
        $this->get('/projects')
            ->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_a_single_project()
    {
        $project = factory(Project::class)->create();

        $this->get($project->path())
            ->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)
            ->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(factory(User::class)->create());

        $project = factory(Project::class)->create(
            ['owner_id' => auth()->id()]
        );

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_user_cannot_view_the_projects_of_others()
    {
        $this->be(factory(User::class)->create());

        $project = factory(Project::class)->create();

        $this->get($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $attributes)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $attributes)
            ->assertSessionHasErrors('description');
    }
}