<?php
namespace App\Services;
use App\Models\Employee;




class GetDataEmployees{
    public function getNameEmployees(){
        $getEmployeeName = new Employee();

        return $getEmployeeName->getName();
    }
}








?>
