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

    /** @test */
    public function job_applicant_can_answer_job_questions()
    {
        $applicant = factory('App\User')->create();
        loginAs($applicant->id);

        $job = factory('App\Job')->create();

        $questions = factory('App\JobQuestion')->create([
            'job_id' => $job->id
        ]);

        $this->get('/' . $job->slugWithPrefix() . '/apply')->assertStatus(200);

        $this->withoutExceptionHandling()
            ->post($job->slugWithPrefix() . '/apply', [
                '1' => "Answer 1",
            ])
            ->assertStatus(302);

        $this->assertDatabaseHas('job_user', [
            'user_id' =>  $applicant->id,
            'job_id' => $job->id
        ]);

        $this->assertDatabaseHas('job_answers',
            [
                'user_id' => $applicant->id,
                'question_id' => $questions->id,
                'answers' => "\"Answer 1\"",
            ]
        );
    }
}
