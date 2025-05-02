<?php

namespace App\Services;

use App\Enum\AttendanceTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\PermitService;
use App\Services\GetDataEmployees;
use App\Models\Employee;

class AttendanceService
{
    public function insert($employeeUID, $checkInTime,$employeeName)
    {
        try {
            echo "Memasukkan data kedatangan ke database....\n";
            $attendanceTime = Carbon::parse($checkInTime);

            //Gabung dengan kedatagan hari ini
            $maxAttendanceTime = Carbon::parse($attendanceTime)->format('Y-m-d') . ' ' .AttendanceTime::CheckIn->value;

            $diffInSeconds = $attendanceTime->diffInSeconds($maxAttendanceTime, true);
            if ($diffInSeconds > 0) {
                $minutes = floor($diffInSeconds / 60);
                $seconds = $diffInSeconds % 60;
                $lateArrival = "{$minutes} menit {$seconds} detik";
            }else {
                $lateArrival = "On Time";
            }

            $permits = new PermitService();
            $name = new GetDataEmployees();


            try {
                return DB::table('attendances')->insert([
                    'employeeUID' => $employeeUID,
                    'employeeName' => $employeeName,
                    'checkInTime' => $checkInTime,
                    'lateArrival' => $lateArrival,//$lateArrival,
                    'checkOutTime' => null,
                    'status' => null, //Masih manual
                    'shiftId' => null //Masih manual
                ]);
            } catch (\Exception $e) {
                // Handle the exception
                echo "Error 2: " . $e->getMessage();
                return false; // or handle the error as needed
            }
        } catch (\Exception $e) {
            // Handle the exception
            echo "Error 1 " . $e->getMessage();
            return false; // or handle the error as needed
        }
    }

    /**
     * Bootstrap services.
     */
    public function update($employeeUID, $checkInTime, $checkOutTime, $shiftId, $status)
    {
        try {
            echo "Memasukkan data pulang ke database.....\n";
            $existingAttendance = DB::table('attendances')
                ->where('employeeUID', $employeeUID)
                ->whereDate('checkInTime', $checkInTime)
                ->whereNull('checkOutTime')
                ->first();

            if ($existingAttendance && !$existingAttendance->checkOutTime) {


                return DB::table('attendances')
                    ->where('employeeUID', $employeeUID)
                    ->whereDate('checkInTime', $checkInTime)
                    ->update([
                        'checkOutTime' => $checkOutTime,
                        'shiftId' => $shiftId, //Masih manual
                        'status' => $status  //Masih manual
                    ]);
            }
        } catch (\Exception $e) {
            echo "Error:" . $e->getMessage();
            return false;
        }
    }
}
