<?php

namespace Tests\Feature;

use App\Job;
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
    public function unauthorized_user_cannot_view_create_job_page()
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

        $this->withoutExceptionHandling()
             ->get('/jobs/' . $job->slug())
             ->assertSee($job->title);
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
                'price' => '300',
                'status' => Job::STATUS_PUBLISHED
            ])
            ->assertSee('jobs/1/create-an-agency-website-using-blutui');

        $this->assertDatabaseHas('jobs', [
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '30000'
        ]);
    }

    /** @test */
    public function store_job_to_database_using_ajax()
    {
        login();

        $this->withoutExceptionHandling()
             ->json('POST', '/jobs', [
                 'title' => 'Create an agency website using blutui',
                 'description' => 'Sleek and beautiful',
                 'price' => '300',
                 'status' => Job::STATUS_PUBLISHED,
             ])
            ->assertStatus(201);

        $this->assertDatabaseHas('jobs', [
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '30000',
            'status' => Job::STATUS_PUBLISHED,
        ]);
    }

    /** @test */
    public function can_update_created_job()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create([
            'user_id' => $jobCreator->id,
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '300',
        ]);

        loginAs($jobCreator->id);

        $this->withoutExceptionHandling()
            ->patch('/jobs/' . $job->id, [
                'title' => 'Updated title',
                'description' => 'Updated title',
                'price' => '500',
                'status' => Job::STATUS_PUBLISHED,
            ])
            ->assertRedirect('jobs/1/updated-title');

        $this->assertDatabaseHas('jobs', [
            'title' => 'Updated title',
            'description' => 'Updated title',
            'price' => '50000',
            'status' => Job::STATUS_PUBLISHED,
        ]);
    }

    /** @test */
    public function can_update_created_job_using_ajax()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create([
            'user_id' => $jobCreator->id,
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '300'
        ]);

        loginAs($jobCreator->id);

        $this->withoutExceptionHandling()
             ->json('PATCH', '/jobs/' . $job->id, [
                 'title' => 'Updated title',
                 'description' => 'Updated title',
                 'price' => '500',
                 'status' => Job::STATUS_PUBLISHED,
             ])->assertStatus(200);

        $this->assertDatabaseHas('jobs', [
            'title' => 'Updated title',
            'description' => 'Updated title',
            'price' => '50000',
            'status' => Job::STATUS_PUBLISHED,
        ]);
    }

    /** @test */
    public function cannot_update_others_job()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $jobCreator->id]);

        $randomUser = factory('App\User')->create();

        loginAs($randomUser->id);

        $this->withExceptionHandling()
            ->patch('/jobs/' . $job->id, [
                'title' => 'Updated title',
                'description' => 'Updated title',
                'price' => '500'
            ])->assertStatus(403);
    }

    /** @test */
    public function guest_can_view_jobs_page()
    {
        $this->withExceptionHandling()
             ->get('/jobs/')
             ->assertStatus(200);
    }

    /** @test */
    public function can_delete_created_job()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create([
            'user_id' => $jobCreator->id,
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '300'
        ]);

        loginAs($jobCreator->id);

        $this->withExceptionHandling()
             ->delete('/jobs/' . $job->id)
             ->assertRedirect('jobs/');

        $this->assertSoftDeleted('jobs', [
            'user_id' => $jobCreator->id,
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '300'
        ]);
    }

    /** @test */
    public function can_delete_created_job_using_ajax()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create([
            'user_id' => $jobCreator->id,
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '300'
        ]);

        loginAs($jobCreator->id);

        $this->withExceptionHandling()
            ->json('DELETE', '/jobs/' . $job->id)->assertStatus(200);

        $this->assertSoftDeleted('jobs', [
            'user_id' => $jobCreator->id,
            'title' => 'Create an agency website using blutui',
            'description' => 'Sleek and beautiful',
            'price' => '300'
        ]);
    }

    /** @test */
    public function cannot_delete_others_job()
    {
        $jobCreator = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $jobCreator->id]);

        $randomUser = factory('App\User')->create();

        loginAs($randomUser->id);

        $this->withExceptionHandling()
             ->delete('/jobs/' . $job->id, [
                'title' => 'Updated title',
                'description' => 'Updated title',
                'price' => '500'
            ])->assertStatus(403);
    }

    /** @test */
    public function can_search_for_jobs()
    {
        factory('App\Job', 10)->create();
        $job1 = factory('App\Job')->create(['title' => 'Web Design with Blutui']);
        $job2 = factory('App\Job')->create(['title' => 'Logo Design with Blutui']);

        $this->get('/jobs/?title=Blutui')
             ->assertSee($job1->title)
             ->assertSee($job2->title);
    }
}
