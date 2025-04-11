<?php

namespace App\Entity;
use PhpParser\Node\Expr\FuncCall;
class UserAttendances{
    private $employeeId;
    private $attendances = [];

public function ___construct($employeeId){ //Membuat construct yang berisi employeeId
    $this->employeeId = $employeeId;
}

//Fungsi untuk menambahkan data kehadiran
public function addAttendance($date, $status, $shift){
    $this->attendances[]= [
        'date' => $date,
        'status'=> $status,
        'shift' => $shift
    ];
}

//Fungsi untuk menghitung jumlah kehadiran dalam rentang waktu tetentu
public function getAttendanceCountInDate($startDate, $endDate){
    return count(array_filter($this->attendances, function ($attendance) use ($startDate, $endDate) {
        return $attendance['date'] >= $startDate && $attendance['date'] <= $endDate;
    }));
}

//Fungsi untuk menghitung jumlah status tertentu dalam rentang waktu tertentu
public function getStatusCountInDate($status, $startDate, $endDate) {
    return count (array_filter($this->attendances, function($attendance) use ($status, $startDate, $endDate){
        return isset ($attendance['status']) && $attendance['status'] == $status &&
        $attendance['date'] >= $startDate && $attendance['date'] <= $endDate;
    }));
}

//Fungsi untuk menghitung jumlah shift tertentu dalam rentang waktu tertentu
public function getShiftCountInDate($shift, $startDate, $endDate) {
    return count(array_filter($this->attendances, function ($attendance) use ($shift, $startDate, $endDate){
        return isset($attendance['shift']) && $attendance['shift'] == $shift &&
                $attendance['date'] >= $startDate && $attendance['date'] <= $endDate;
    }));
}






}
?>
