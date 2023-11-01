<?php

namespace Tests\Feature\Api\V1;

use App\Models\Hardware;
use App\Models\HardwareModel;
use App\Models\HardwareStatus;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\ApiCase;

class HardwareTest extends ApiCase
{
    use RefreshDatabase;

    public function test_can_fetch_all_hardware()
    {
        $response = $this->get('/api/v1/hardware');
        $response->assertStatus(200);
    }

    public function test_can_create_hardware()
    {
        $team = Team::factory()->create();
        $hardwareModel = HardwareModel::factory()->create(['team_id' => $team->id]);
        $hardwareStatus = HardwareStatus::factory()->create(['team_id' => $team->id]);

        $hardwareData = [
            'name' => 'Sample Hardware',
            'order_number' => '12345',
            'team_id' => $team->id,
            'hardware_model_id' => $hardwareModel->id,
            'hardware_status_id' => $hardwareStatus->id,
        ];

        $response = $this->post('/api/v1/hardware', $hardwareData);
        $response->assertStatus(201);

        $hardware = Hardware::latest()->first();
        $this->assertEquals('Sample Hardware', $hardware->name);
    }

    public function test_can_update_hardware()
    {
        $hardware = Hardware::factory()->create();

        $updatedName = 'Updated Hardware Name';
        $response = $this->put("/api/v1/hardware/{$hardware->id}", ['name' => $updatedName]);
        $response->assertStatus(200);

        $updatedHardware = Hardware::find($hardware->id);
        $this->assertEquals($updatedHardware->name, $updatedName);
    }

    public function test_can_show_hardware()
    {
        $hardware = Hardware::factory()->create();

        $response = $this->get("/api/v1/hardware/{$hardware->id}");
        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name' => $hardware->name,
        ]);
    }

    public function test_can_delete_hardware()
    {
        $hardware = Hardware::factory()->create();

        $response = $this->delete("/api/v1/hardware/{$hardware->id}");
        $response->assertStatus(204);

        $this->assertDatabaseMissing('hardware', ['id' => $hardware->id]);
    }

    public function test_show_returns_404_if_hardware_not_found()
    {
        $nonExistentId = 999;

        $response = $this->get("/api/v1/hardware/{$nonExistentId}");
        $response->assertStatus(404);
    }

    public function test_destroy_returns_404_if_hardware_not_found()
    {
        $nonExistentId = 999;

        $response = $this->delete("/api/v1/hardware/{$nonExistentId}");
        $response->assertStatus(404);
    }

    public function test_update_returns_404_if_hardware_not_found()
    {
        $nonExistentId = 999;
        $updatedData = [
            'name' => 'Updated Name',
        ];

        $response = $this->put("/api/v1/hardware/{$nonExistentId}", $updatedData);
        $response->assertStatus(404);
    }
}
