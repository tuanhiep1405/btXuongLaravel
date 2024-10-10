<?php

use App\Http\Controllers\Api\ProjectController as ApiProjectController;
use App\Http\Controllers\Api\TaskController as ApiTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Quản lý dự án


Route::apiResource('/projects', ApiProjectController::class);


// Quản lý nhiệm vụ trong từng dự án (nested routes)
Route::apiResource('/projects/{id}/tasks', ApiTaskController::class);

