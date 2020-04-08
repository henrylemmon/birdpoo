<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owners_may_not_invite_users()
    {
         $project = Projectfactory::create();
         $user = factory(User::class)->create();

         $assertInvitationForbidden = function () use ($user, $project) {
             $this->actingAs($user)
                 ->post($project->path() . '/invitations')
                 ->assertStatus(403);
         };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = Projectfactory::create();

        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->owner)
                ->post($project->path() . '/invitations', [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_birdshit_account()
    {
        $project = Projectfactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@mail.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are attempting to invite must have a birdshit account.'
            ], null, 'invitations');
    }

    /** @test */
    public function invited_users_may_update_project_details()
    {
        $project = Projectfactory::create();

        $project->invite($newUser = factory(User::class)->create());
        $this->signIn($newUser);

        $this->post(action('ProjectTasksController@store', $project->id), $task = ['body' => 'Foo Task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
