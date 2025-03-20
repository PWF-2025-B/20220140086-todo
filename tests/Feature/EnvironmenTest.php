<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testEnv()
    {
        $appName = env("YOUTUBE");

        self::assertEquals("Programer Zaman Now", $appName);
    }
}