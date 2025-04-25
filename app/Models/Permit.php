<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $table = 'permits';

    protected $fillable = [
        'employeeUID',
        'attendanceId',
        'permitType',
        'startDate',
        'endDate',
        'approvalBy'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeUID', 'employeeUID');
    }



}
