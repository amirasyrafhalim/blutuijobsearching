<?php

namespace Tests\Unit;

use App\Job;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class JobTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /** @test */
    public function a_job_has_its_slug()
    {
        $job = factory('App\Job')->create(['title' => 'Blutui Marketplace']);

        $this->assertEquals('1/blutui-marketplace', $job->slug());
    }

    /** @test */
    public function can_get_currency_friendly_format()
    {
        $job = factory('App\Job')->create(['price' => '10000']);

        $this->assertEquals('100.00', $job->priceInCurrency());
    }

    /** @test */
    public function return_true_if_authenticated_user_is_job_owner()
    {
        $user = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $user->id]);

        loginAs($user->id);

        $this->assertTrue($job->isOwner());
    }

    /** @test */
    public function return_true_if_user_is_jobs_owner()
    {
        $user = factory('App\User')->create();
        $job = factory('App\Job')->create(['user_id' => $user->id]);

        loginAs($user->id);

        $this->assertTrue($job->isOwnedBy($user));
    }

    /** @test */
    public function return_false_if_user_is_guest()
    {
        $job = factory('App\Job')->create();

        $this->assertFalse($job->isOwner());
    }

    /** @test */
    public function job_has_excerpt_less_character_than_its_description()
    {
        $job = factory('App\Job')->create();

        $this->assertLessThan(strlen($job->description), strlen($job->excerpt()));
    }

    /** @test */
    public function search_job_by_its_title()
    {
        factory('App\Job', 10)->create();
        factory('App\Job')->create(['title' => 'Web Design with Blutui']);
        factory('App\Job')->create(['title' => 'Logo Design with Blutui']);

        $searchedJobs = Job::byTitleContains('Blutui')->get();

        $this->assertEquals(2, $searchedJobs->count());
    }

    /** @test */
    public function query_published_job()
    {
        factory('App\Job', 10)->create(['status' => Job::STATUS_DRAFT]);
        factory('App\Job')->create(['status' => Job::STATUS_PUBLISHED]);
        factory('App\Job')->create(['status' => Job::STATUS_PUBLISHED]);

        $publishedJobs = Job::published();

        $this->assertEquals(2, $publishedJobs->count());
    }
}
