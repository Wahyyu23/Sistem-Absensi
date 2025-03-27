<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'employeeId',
        'username',
        'password',
        'employeeName',
        'dateOfBirth',
        'employeePhone',
        'employeeEmail',
        'profilePicture',
        'position',
        'department',
        'hireDate',
        'terminationDate'
    ];

    //Relasi dengan attendance
    public function attendances(){

        return $this->hasMany(Attendance::class);
    }
}
