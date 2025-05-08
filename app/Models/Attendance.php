<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function Psy\sh;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'employeeUID',
        'employeeName',
        'checkInTime',
        'lateArrival',
        'checkOutTime',
        'status',
        'shiftId'
    ];

    //Relasi dengan employye
    public function employee()
    {

        return $this->belongsTo(Employee::class);
    }

    //Relasi dengan shift
    public function shift()
    {

        return $this->belongsTo(Shifts::class);
    }

    public function permit()
    {

        return $this->belongsTo(Permit::class);
    }

    public function getAttendance($employeeUID, $attendanceTime)
    {
        return self::where('employeeUID', $employeeUID)
            ->whereDate('checkInTime', $attendanceTime)
            ->first();
    }

    public function checkAttendance($employeeUID, $checkInTime)
    {
        $attendance = DB::table('attendances')
            ->where('employeeUID', $employeeUID)
            ->whereDate('checkInTime', $checkInTime)
            ->whereNull('checkOutTime')
            ->first();

        return $attendance;
    }

    public function insertAttendance($employeeUID, $employeeName, $checkInTime, $lateArrival)
    {
    try{
        return DB::table('attendances')->insert([
            'employeeUID' => $employeeUID,
            'employeeName' => $employeeName,
            'checkInTime' => $checkInTime,
            'lateArrival' => $lateArrival,
            'checkOutTime' => null,
            'status' => null,
            'shiftId' => null
        ]
    );
    }catch (\Exception $e) {
        echo "Error di inserAttendance: " . $e->getMessage();
        return false;
    };
  }

  public function updateAttendance($employeeUID, $checkInTime, $checkOutTime, $shiftId, $status)
  {
    try{
        return DB::table('attendances')
        ->where('employeeUID', $employeeUID)
        ->whereDate('checkInTime', $checkInTime)
        ->update([
            'checkOutTime' => $checkOutTime,
            'shiftId' => $shiftId,
            'status' => $status
        ]);
    }catch (\Exception $e) {
        echo "Error di updateAttendance: " . $e->getMessage();
        return false;
    }
  }
}

