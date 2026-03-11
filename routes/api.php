<?php

use App\Http\Controllers\Api\WorkTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/reports/work-tasks/resolutions', [WorkTaskController::class, 'getTasks']);
