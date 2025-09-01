<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get(uri:'/');

        $response->assertStatus(status:200);
    }

    public function test_index_TeamsController_getTeams_ReturnStatus200(): void
    {
        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/teams");
        $response->assertStatus(status:200);
    }
}
