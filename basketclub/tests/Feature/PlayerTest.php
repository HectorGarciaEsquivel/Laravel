<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get(uri:'/');

        $response->assertStatus(status:200);
    }

    public function test_index_PlayerController_getPlayers_ReturnStatus200(): void
    {
        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/players");
        $response->assertStatus(status:200);
    }

    public function test_show_PlayerController_getPlayerById_ReturnStatus404(): void
    {
        $playerId = 1;
        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"{$ver}/player/{$playerId}");
        $response->assertStatus(status:404);
    }
}