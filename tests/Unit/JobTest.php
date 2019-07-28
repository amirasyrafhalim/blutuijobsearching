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
}
