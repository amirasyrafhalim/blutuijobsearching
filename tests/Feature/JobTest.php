<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /** @test */
    public function can_view_create_job_page()
    {
        login();

        $this->withoutExceptionHandling()
             ->get('jobs/create')
             ->assertStatus(200);
    }

    /** @test */
    public function unauthorized_user_view_create_job_page()
    {
        $this->withExceptionHandling()
            ->get('jobs/create')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function can_view_created_jobs()
    {
        $job = factory('App\Job')->create();

        $this->withExceptionHandling()
             ->get('/jobs/' . $job->slug())
             ->assertSee($job->title)
             ->assertStatus(200);
    }

    /** @test */
    public function can_view_edit_job_page()
    {
        $user = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $user->id]);

        loginAs($user->id);

        $this->withoutExceptionHandling()
             ->get('/jobs/' . $job->id . '/edit')
             ->assertStatus(200);
    }

    /** @test */
    public function cannot_view_edit_others_job_page()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $jobCreator->id]);

        $randomUser = factory('App\User')->create();

        loginAs($randomUser->id);

        $this->withExceptionHandling()
            ->get('/jobs/' . $job->id . '/edit')
            ->assertStatus(403);
    }

    /** @test */
    public function store_job_to_database()
    {
        login();

        $this->withoutExceptionHandling()
             ->post('/jobs', [
                'title' => 'Create an agency website using blutui',
                'description' => 'Sleek and beautiful',
                'price' => '300'])
            ->assertStatus(201);
    }
}
