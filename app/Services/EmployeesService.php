<?php
namespace App\Services;
use App\Models\Employee;




class EmployeesService{
    protected $employee;


    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getNameEmployees($employeeUID)
    {
        return $this->employee->getNamebyUID($employeeUID);
    }

    public function getAllEmployees()
    {
        return $this->employee->getEmployee();
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
                                    $terminationDate)
    {
        return $this->employee->updateEmployee($id,
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
                                                $terminationDate);
    }
}








?>
