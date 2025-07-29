<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     return response()->json(['message' => 'API is working']);
// });

// Route::post('/registerShift', [ShiftController::class, 'register']);
//
// Route::apiResource('registerShift', ShiftController::class);

//Route::get('/test', [EmployeeController::class, 'index']);
//Route::apiResource('/addEmplooyee', EmployeeController::class, 'store');
//Route::apiResource('/employees', EmployeeController::class);

//Route Baru
//1. Menampilkan semua data pegawai (GET)
Route::get('/employees', [EmployeeController::class, 'showEmployee']); //Done
//2. Menampilkan semua data absen (GET)
Route::get('/attendance', [AttendanceController::class, 'showAttendance']); //Done

//3. Menampilkan data absen berdasarkan nama dan tanggal (POST -> lewat form)
Route::post('/attendance/search', [AttendanceController::class, 'searchAttendance']); //Belum di tes

//4. Mengupdate data pegawai (PUT)
Route::put('/employees/{id}', [EmployeeController::class, 'updateEmployee']); //Done

//5. Menghapus data pegawai (DELETE)
Route::delete('/employees/{id}', [EmployeeController::class, 'deleteEmployee']);









