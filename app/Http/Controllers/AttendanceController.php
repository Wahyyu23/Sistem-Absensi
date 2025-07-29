<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function showAttendance()
    {
        try {
            $response = $this->attendanceService->getAllAttendance();

            return response()->json([
                'status' => 'Data absen berhasil diambil',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Kesalahan saat mengambil data',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function searchAttendance(Request $request)
    {
        $employeeName = $request->input('employeeName');
        $date = $request->input('date');

        try {
            $response = $this->attendanceService->searchAttendance($employeeName, $date);

            return response()->json([
                'status' => 'Data absen berhasil ditemukan',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Kesalahan saat mencari data',
                'message' => $e->getMessage()
            ]);
        }

    }
}
