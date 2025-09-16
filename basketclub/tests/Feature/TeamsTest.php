<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Team;
use Tests\TestCase;

class TeamsTest extends TestCase
{
    use RefreshDatabase;
    
    /*
    * Test sobre endpoint /teams
    * Uso de GET Teams
    */
    public function test_index_TeamsController_getTeams_ReturnStatus200(): void
    {
        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/teams");
        $response->assertStatus(status:200);
    }

    /*
    * Test sobre endpoint /teams/{id}
    * Uso de GET Teams
    */
    public function test_show_TeamsController_getTeamId_ReturnStatus200(): void
    {
        $team = Team::factory()->create();

        $ver = env(key:"APP_VER");
        $response = $this->get(uri:"/{$ver}/teams/{$team->id}");
        $response->assertStatus(status:200)
                 ->assertJson(value: [
                    'id'       => $team->id,
                    'name'     => $team->name,
                    'category' => $team->category,
                    'gender'   => $team->gender,
                ]);
    }

    /*
    * Test sobre endpoint /teams
    * Uso de POST Teams
    * Creacion
    */
    public function test_store_TeamsController_createTeam_ReturnStatus201(): void
    {
        $ver = env(key:"APP_VER");
        $team = [
            'name'     => 'Real Madrid',
            'category' => 'senior',
            'gender'   => 'male',
        ];
        $response = $this->post(uri:"/{$ver}/teams", data:$team);
        $response->assertStatus(status: 201)
                 ->assertJsonFragment(data: [
                     'name'     => $team['name'],
                     'category' => $team['category'],
                     'gender'   => $team['gender'],
                 ]);
    }

    /*
    * Test sobre endpoint /temas
    * Uso de PUT teams
    * Actualización
    */
    public function test_update_TeamsController_updateTeam_RetrunStatus200(): void
    {
        $team = Team::factory()->create();

        $ver = env(key:"APP_VER");
        $teamUpdate = [
            'name'     => 'Manchester',
            'category' => 'alevines',
            'gender'   => 'mixed',
        ];

        $response = $this->put(uri:"/{$ver}/teams/{$team->id}", data:$teamUpdate);
        $response->assertStatus(status:200)
                 ->assertJsonFragment(data: [
                     'id'       => $team->id,
                     'name'     => $teamUpdate['name'],
                     'category' => $teamUpdate['category'],
                     'gender'   => $teamUpdate['gender'],
                 ]);
    }

    /*
    * Test sobre endpoint /teams
    * Uso de DELETE teams
    * Eliminación
    */
    public function test_delete_TeamController_deleteTeam_ReturnStatus204(): void
    {
        $team = Team::factory()->create();

        $ver = env(key: "APP_VER");
        $response = $this->delete(uri:"/{$ver}/teams/{$team->id}");
        $response->assertStatus(status: 200);
    }
}