<?php

namespace Database\Seeders;

use App\Models\Call;
use App\Models\ResolutionType;
use App\Models\WorkTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resolutionTypes = ResolutionType::all();
        
        Call::factory()
            ->count(20)
            ->create()
            ->each(function ($call) use ($resolutionTypes) {
                WorkTask::factory()->create([
                    'call_id' => $call->id,
                    'resolution_type_id' => $resolutionTypes->random()->id
                ]);
            });
    }
}
