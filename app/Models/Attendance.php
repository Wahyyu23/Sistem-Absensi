<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Psy\sh;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'employeeId',
        'checkInTime',
        'checkOutTime',
        'status',
        'shiftId'
    ];

    //Relasi dengan employye
    public function employee(){

        return $this->belongsTo(Employee::class);
    }

    //Relasi dengan shift
    public function shift(){

        return $this->belongsTo(Shifts::class);
    }
}

