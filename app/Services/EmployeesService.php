<?php
namespace App\Services;
use App\Models\Employee;




class EmployeesService{
    public function getNameEmployees($employeeUID){
        $getEmployeeName = new Employee();

        return $getEmployeeName->getNamebyUID($employeeUID);
    }
}








?>
