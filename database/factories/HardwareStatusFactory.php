<?php

namespace Database\Factories;

use App\Models\HardwareStatus;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class HardwareStatusFactory extends Factory
{
    protected $model = HardwareStatus::class;

    public function definition()
    {
        $team = Team::factory()->create();

        return [
            'name' => $this->faker->randomElement(['Active', 'Inactive', 'Under Maintenance']),
            'team_id' => $team->id,
        ];
    }
}
