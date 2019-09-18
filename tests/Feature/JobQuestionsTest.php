<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobQuestionsTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /** @test */
    public function can_view_job_questions_page()
    {
        $job = factory('App\Job')->create();

        $this->withoutExceptionHandling()
             ->get('/' . $job->slugWithPrefix() . '/questions')
             ->assertStatus(200);
    }

    /** @test */
    public function can_add_questions_to_job()
    {
        $user = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $user->id]);

        $question = [
            'title' => 'How long do you take to finish this job?',
            'description' => 'Can you finish this job in 3 days?',
            'attributes' => "{\"required\": \"true\", \"type\": \"textarea\"}"
        ];
        $this->withoutExceptionHandling()
             ->json("POST", '/' . $job->slugWithPrefix() . '/questions', $question);

        $this->assertDatabaseHas('job_questions', $question);
    }
}
