<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WorkTaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkTaskController extends Controller
{
    public function getTasks (Request $request, WorkTaskService $workTaskService): JsonResponse
    {
        $data = $request->validate([
            'from' => ['required', 'date'],
            'to' => ['required', 'date']
        ]);

        $results = $workTaskService->getResolutionTypes($data['from'], $data['to']);

        return response()->json([
            'resolutionTypes' => $results
        ]);
    }
}
