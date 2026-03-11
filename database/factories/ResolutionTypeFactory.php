<?php

namespace Database\Factories;

use App\Models\ResolutionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResolutionType>
 */
class ResolutionTypeFactory extends Factory
{
    protected $model = ResolutionType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->sentence(3),
            'description' => fake()->sentence()
        ];
    }
}
