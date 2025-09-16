<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Player;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_PlayerController_getPlayers_ReturnStatus200(): void
    {
        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/players");
        $response->assertStatus(status:200);
    }

    /**
    * Test sobre endpoint /players
    * Uso de GET Players
    */
    public function test_index_PlayerController_getAllPlayers(): void
    {
        $players = Player::factory()->count(5)->create();

        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/players");
        $response->assertStatus(status: 200)
                 ->assertJsonCount(count: 5);
    }

    /**
    * Test sobre endpoint /players/{id}
    * Uso de GET Players
    */
    public function test_show_PlayerController_getPlayerId(): void
    {
        $player = Player::factory()->create();

        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/players/{$player->id}");
        $response->assertStatus(status: 200)
                 ->assertJson(value: [
                    'id'         => $player->id,
                    'first_name' => $player->first_name,
                    'last_name'  => $player->last_name,
        ]);
    }

    /**
    * Test sobre endpoint /players
    * Uso de POST Players
    * Error
    */
    public function test_store_error_PlayerController_postPlayer(): void
    {
        $player = [
            'first_name' => 'Lucia',
            'last_name'  => 'Fernandez',
            'date_birth' => '2018-01-01',
        ];

        $ver = env(key:"APP_VER");
        $response = $this->postJson(uri:"/{$ver}/players", data: $player);
        $response->assertStatus(status: 422);
    }

    /**
    * Test sobre endpoint /players
    * Uso de POST Players
    * Creacion
    */
    public function test_store_PlayerController_postPlayer(): void
    {
        $player = [
            'first_name' => 'Lucia',
            'last_name'  => 'Fernandez',
            'date_birth' => '2018-01-01',
            'gender'     => 'famale',
        ];

        $ver = env(key:"APP_VER");
        $response = $this->postJson(uri:"/{$ver}/players", data: $player);
        $response->assertStatus(status: 201)
                 ->assertJsonFragment(data: [
                    'first_name' => $player['first_name'],
                    'last_name'  => $player['last_name'],
                 ]);
    }
}