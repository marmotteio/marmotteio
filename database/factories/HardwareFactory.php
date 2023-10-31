<?php

namespace Database\Factories;

use App\Models\Hardware;
use App\Models\HardwareModel;
use App\Models\HardwareStatus;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class HardwareFactory extends Factory
{
    protected $model = Hardware::class;

    public function definition()
    {
        $team = Team::factory()->create();
        $hardwareModel = HardwareModel::factory()->create();
        $hardwareStatus = HardwareStatus::factory()->create();

        return [
            'name' => $this->faker->word,
            'order_number' => $this->faker->randomNumber(),
            'team_id' => $team->id,
            'hardware_model_id' => $hardwareModel->id,
            'hardware_status_id' => $hardwareStatus->id,
        ];
    }
}
