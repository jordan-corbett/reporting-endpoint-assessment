<?php

namespace App\Services;

use App\Models\WorkTask;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WorkTaskService
{
    public function getResolutionTypes (string $from, string $to): Collection
    {
        return WorkTask::query()
            ->join('resolution_types', 'work_tasks.resolution_type_id', '=', 'resolution_types.id')
            ->join('calls', 'work_tasks.call_id', '=', 'calls.id')
            ->whereBetween('work_tasks.created_at', [$from, $to])
            ->whereNotIn('calls.stage', ['Draft', 'Archived'])
            ->whereNotNull('work_tasks.resolution_type_id')
            ->select(
                'resolution_types.id',
                'resolution_types.name',
                'resolution_types.description',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy(
                'resolution_types.id',
                'resolution_types.name',
                'resolution_types.description'
            )
            ->orderByDesc('count')
            ->get();
    }
}
