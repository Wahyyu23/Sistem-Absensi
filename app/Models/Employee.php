<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    public $timestamps = false;

    protected $fillable = [
        'employeeUID',
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

    public function permits(){

        return $this->hasMany(Permit::class);
    }

    public function getUID()
    {
        return $this->employeeUID;
    }
    public static function getNamebyUID($uid)
    {
        return self::where('employeeUID', $uid)->first();
    }

    public function getEmployee()
    {
        return self::all();
    }

    public function updateEmployee($id,
                                   $uid,
                                   $username,
                                   $password,
                                   $employeeName,
                                   $dateOfBirth,
                                   $employeePhone,
                                   $employeeEmail,
                                   $profilePicture,
                                   $position,
                                   $department,
                                   $hireDate,
                                   $terminationDate
                                   )
                                   {
    return self::where('id', $id)->update([
        'employeeUID' => $uid,
        'username' => $username,
        'password' => $password,
        'employeeName' => $employeeName,
        'dateOfBirth' => $dateOfBirth,
        'employeePhone' => $employeePhone,
        'employeeEmail' => $employeeEmail,
        'profilePicture' => $profilePicture,
        'position' => $position,
        'department' => $department,
        'hireDate' => $hireDate,
        'terminationDate' => $terminationDate
    ]);
  }
}
