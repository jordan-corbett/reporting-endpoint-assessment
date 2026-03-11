<?php

namespace Database\Factories;

use App\Models\Call;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Call>
 */
class CallFactory extends Factory
{
    protected $model = Call::class;

    public function definition(): array
    {
        return [
            'notes' => fake()->sentence(),
            'stage' => fake()->randomElement([
                'Open',
                'Closed',
                'In Progress',
                'Draft',
                'Archived'
            ])
        ];
    }

    public function isActive()
    {
        return $this->state([
            'status' => 'Open'
        ]);
    }
}
