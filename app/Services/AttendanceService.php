<?php

namespace App\Services;

use App\Enum\AttendanceTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\PermitService;
use App\Models\Attendance;
use App\Services\EmployeesService;
use App\Models\Employee;

class AttendanceService
{
    protected $attendance;
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function insert($employeeUID, $checkInTime, $employeeName)
    {
        try {
            echo "Memasukkan data kedatangan ke database....\n";
            $attendanceTime = Carbon::parse($checkInTime);
            //$attendanceTimeYearMonthDay = Carbon::parse($checkInTime)->format('Y-m-d');

            $workHour = Carbon::parse($attendanceTime)->format('Y-m-d') . ' ' . AttendanceTime::CheckIn->value;
            $maxAttendanceTime = Carbon::parse($workHour);
            echo $maxAttendanceTime . "\n";
            echo $attendanceTime . "\n";

            $diffInSeconds = $maxAttendanceTime->diffInSeconds($attendanceTime, false);

            echo $diffInSeconds . "\n";
            if ($diffInSeconds > 0) {
                $minutes = floor($diffInSeconds / 60);
                $seconds = $diffInSeconds % 60;
                $lateArrival = "{$minutes} menit {$seconds} detik";
            } else {
                $lateArrival = "On Time";
            }

            try {
                $resultInsert = $this->attendance->insertAttendance($employeeUID, $employeeName, $checkInTime, $lateArrival);
                if ($resultInsert) {
                    echo "Data berhasil dimasukkan ke database.\n";
                    return true;
                } else {
                    echo "Gagal memasukkan data ke database.\n";
                    return false;
                }
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

    public function update($employeeUID, $checkInTime, $checkOutTime, $shiftId, $status)
    {
        try {
            echo "Memasukkan data pulang ke database.....\n";
            $existingAttendance = $this->attendance->checkAttendance($employeeUID, $checkInTime);

            if ($existingAttendance && !$existingAttendance->checkOutTime) {

                $updateData = $this->attendance->updateAttendance($employeeUID, $checkInTime, $checkOutTime, $shiftId, $status);
                if ($updateData) {
                    echo "Data Pulang berhasil diupdate ke database.\n";
                    return true;
                } else {
                    echo "Gagal mengupdate data pulang ke database.\n";
                    return false;
                }
            }
        } catch (\Exception $e) {
            echo "Error:" . $e->getMessage();
            return false;
        }
    }

    public function parseIntoCarbonComplete($datetime)
    {
        try {
            $time = Carbon::parse($datetime)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            echo "Gagal mengubah format carbon untuk format data mqtt Y-m-d H:i:s\n" . $e->getMessage();
        }
        return $time;
    }

    public function parseIntoCarbonYearMonthDay($datetime)
    {
        try {
            $time = Carbon::parse($datetime)->format('Y-m-d');
        } catch (\Exception $e) {
            echo "Gagal mengubah format carbon untuk format data mqtt Y-m-d\n" . $e->getMessage();
        }
        return $time;
    }

    public function checkAttendance($employeeUID, $attendanceTime)
    {
        return $this->attendance->getAttendance($employeeUID, $attendanceTime);
    }
}
