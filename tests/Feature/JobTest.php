<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /** @test */
    public function can_view_created_jobs()
    {
        $job = factory('App\Job')->create();

        $this->withExceptionHandling()
             ->get('/jobs/' . $job->slug())
             ->assertSee($job->title)
             ->assertStatus(200);
    }
}
