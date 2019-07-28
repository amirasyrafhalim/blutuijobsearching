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
}
