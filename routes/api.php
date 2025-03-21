<?php

use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     return response()->json(['message' => 'API is working']);
// });

// Route::post('/registerShift', [ShiftController::class, 'register']);
Route::apiResource('registerShift', ShiftController::class);

