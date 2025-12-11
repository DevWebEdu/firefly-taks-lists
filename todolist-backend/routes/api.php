<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con JWT
Route::middleware('jwt.verify')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rutas de tareas
    Route::apiResource('tasks', TaskController::class);
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus']);
});
