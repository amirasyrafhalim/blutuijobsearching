<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobQuestionTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
