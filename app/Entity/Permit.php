<?php
namespace App\Entity;
require_once 'app/Enum/AttendanceStatus.php';
require_once 'app/Enum/Approval.php';


class Permit{
    private $id;
    private $employeeId;
    private $attendanceId;
    private $permitFor; //= new AttendanceStatus();
    private $startDate; //= new DateTime();
    private $endDate; //= new DateTime();
    private $approvalBy; //= new Admin();


    public function __construct($employeeId, $attendanceId, $permitFor, $startDate, $endDate){
        $this->employeeId = $employeeId;
        $this->attendanceId = $attendanceId;
        $this->permitFor = $permitFor;
        $this->startDate = $startDate;
        $this->endDate = $startDate;
    }

}

?>
