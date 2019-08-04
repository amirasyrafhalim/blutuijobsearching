<?php

namespace Tests\Feature;

use App\Job;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobApplicationTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function authenticated_user_can_submit_for_job_application()
    {
        $job = factory('App\Job')->create();
        $applicant = factory('App\User')->create();
        loginAs($applicant->id);

        $this->withoutExceptionHandling()
             ->post($job->slugWithPrefix() . '/apply')
             ->assertStatus(302);

        $this->assertDatabaseHas('job_user', [
            'user_id' =>  $applicant->id,
            'job_id' => $job->id
        ]);
    }
}
