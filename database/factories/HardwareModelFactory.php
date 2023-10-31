<?php

namespace Database\Factories;

use App\Models\HardwareModel;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class HardwareModelFactory extends Factory
{
    protected $model = HardwareModel::class;

    public function definition()
    {
        $team = Team::factory()->create();

        return [
            'name' => $this->faker->word,
            'team_id' => $team->id,
        ];
    }
}
