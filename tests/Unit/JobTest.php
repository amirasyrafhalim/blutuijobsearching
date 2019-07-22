<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /** @test */
    public function a_job_has_its_slug()
    {
        $job = factory('App\Job')->create();

        $this->assertEquals($job->id . '/' . Str::slug($job->title), $job->slug());
    }
}
