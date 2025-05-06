<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Psy\sh;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'employeeUID',
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
}

