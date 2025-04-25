<?php

namespace App\Services;

use App\Enum\AttendanceTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceService
{
    public function insert($employeeUID, $checkInTime)
    {
        try {
            echo "Memasukkan data kedatangan ke database....\n";
            $maxAttendanceTime = Carbon::parse(AttendanceTime::CheckIn->value);
            $attendanceTime = Carbon::parse($checkInTime);


            $attendanceTime = $attendanceTime->format('H:i:s');
            $maxAttendanceTime = $maxAttendanceTime->format('H:i:s');

            try {
                $lateArrival = $attendanceTime > $maxAttendanceTime ?
                    Carbon::parse($attendanceTime)->diffInMinutes(Carbon::parse($maxAttendanceTime))  //Harus jadi fungsi tersendiri
                    : 0;
            } catch (\Exception $e) {
                // Handle the exception
                echo "Error: " . $e->getMessage();
                return false; // or handle the error as needed
            }
            try {
                return DB::table('attendances')->insert([
                    'employeeUID' => $employeeUID,
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
