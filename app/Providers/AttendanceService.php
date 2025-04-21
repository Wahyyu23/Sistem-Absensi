<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Enum\AttendanceTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceService extends ServiceProvider
{


    public function insert($employeeUID, $checkInDate, $checkInTime)
    {
        $maxAttendanceTime = Carbon::parse(AttendanceTime::CheckIn->value);
        $attendanceTime = Carbon::parse($checkInTime);

        $lateArrival = $attendanceTime->gt($maxAttendanceTime) ? $attendanceTime
                                      ->diffInMinutes($maxAttendanceTime)
                                      : 0;
        return DB::table('attendances')->insert([
            'employeeId' => $employeeUID,
            'checkInTime' => $checkInTime,
            'checkInDate' => $checkInDate,
            'checkInDay' => now()->format('l'),
            'lateArrival' => $lateArrival,
            'status' => 'Hadir', //Masih manual
            'shiftId' => 1, //Masih manual
            'created_at' => now(),
            'updated_at' => now(),
            'checkOutTime' => null,
            'checkOutDate' => null,
            'checkOutDay' => null
        ]);

    }

    /**
     * Bootstrap services.
     */
    public function update($employeeUID, $checkInDate, $checkInTime, $checkOutDate, $checkOutTime)
    {
        $existingAttendance = DB::table('attendances')
            ->where('employeeId', $employeeUID)
            ->where('checkInTime', $checkInTime)
            ->where('checkInDate', $checkInDate)
            ->first();

        if ($existingAttendance && !$existingAttendance->checkOutTime
                                && now()->diffMinutes(Carbon::parse($existingAttendance->checkInTime)) > 5) {
            return DB::table('attendances')
            ->where('employeeId', $employeeUID)
            ->where('checkInTime', $checkInTime)
            ->where('checkInDate', $checkInDate)
            ->update([
                'checkOutTime' => $checkOutTime,
                'checkOutDate' => $checkOutDate,
            ])
        }
    }
}
