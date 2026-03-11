<?php

namespace Database\Factories;

use App\Models\Call;
use App\Models\ResolutionType;
use App\Models\WorkTask;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkTask>
 */
class WorkTaskFactory extends Factory
{
    protected $model = WorkTask::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-10 days', '-2 days');
        $end = (clone $start)->modify('+' . rand(1,4) . ' hours');

        return [
            'call_id' => Call::factory(),
            'resolution_type_id' => ResolutionType::factory(),
            'work_started_at' => $start,
            'work_completed_at' => $end,
            'created_at' => fake()->dateTimeBetween('-10 days', 'now')
        ];
    }

    public function withoutResolution()
    {
        return $this->state([
            'resolution_type_id' => null
        ]);
    }
}
