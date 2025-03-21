<?php

use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

Route::post('/registerShift', [ShiftController::class, 'register']);
