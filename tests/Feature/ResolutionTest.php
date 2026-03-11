<?php

namespace Tests\Feature;

use App\Models\Call;
use App\Models\ResolutionType;
use App\Models\WorkTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResolutionTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_tasks_route_exists (): void
    {
        $url = 'api/reports/work-tasks/resolutions?from=2020-01-01&to=2020-01-02';
        $response = $this->get($url);

        $response->assertOk();
    }

    public function test_route_returns_resolution_type_counts (): void
    {
        $resA = ResolutionType::factory()->create([
            'name' => 'Fix Complete'
        ]);

        $resB = ResolutionType::factory()->create([
            'name' => 'Awaiting Parts'
        ]);

        $call = Call::factory()->create([
            'stage' => 'Open'
        ]);

        for ($i = 0; $i < 3; $i++) {
            WorkTask::factory()->create([
                'call_id' => $call->id,
                'resolution_type_id' => $i === 2 ? $resB->id : $resA->id,
                'created_at' => now()
            ]);
        }

        $response = $this->getJson('/api/reports/work-tasks/resolutions?from=2020-01-01&to=2030-01-01');

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $resA->id,
                'count' => 2
            ])
            ->assertJsonFragment([
                'id' => $resB->id,
                'count' => 1
            ]);
    }

    public function test_draft_and_archived_calls_ignored (): void
    {
        $callA = Call::factory()->create([
            'stage' => 'Draft'
        ]);

        $callB = Call::factory()->create([
            'stage' => 'Archived'
        ]);

        $res = ResolutionType::factory()->create();

        WorkTask::factory()->create([
            'call_id' => $callA->id,
            'resolution_type_id' => $res->id,
            'created_at' => now()
        ]);

        WorkTask::factory()->create([
            'call_id' => $callB->id,
            'resolution_type_id' => $res->id,
            'created_at' => now()
        ]);

        $response = $this->getJson('/api/reports/work-tasks/resolutions?from=2020-01-01&to=2030-01-01');

        $response->assertOk()
            ->assertJsonMissing([
                'id' => $res->id,
                'count' => 1
            ])
            ->assertJsonMissing([
                'id' => $res->id,
                'count' => 2
            ]);
    }

    public function test_tasks_outside_date_range_excluded (): void
    {
        $res = ResolutionType::factory()->create();

        WorkTask::factory()->create([
            'resolution_type_id' => $res->id,
            'created_at' => '1521-05-04'
        ]);

        $response = $this->getJson('/api/reports/work-tasks/resolutions?from=2020-01-01&to=2030-01-01');

        $response->assertOk()
            ->assertJsonMissing([
                'id' => $res->id,
                'count' => 1
            ]);
    }
}
