<?php
namespace App\Entity;

require_once __DIR__ . '/UserAttendances.php';
require_once __DIR__ . '/Shift.php';
require_once __DIR__ . '/app/Enum/AttendanceTime.php';

use App\Entity\UserAttendances;
use App\Entity\Shift;
use App\Enum\AttendanceTime;
use DateTime;


class Attendance{
    private $id;
    private $employeeId;
    private $checkInTime;
    private $checkOutTime;
    private $status;
    private $shift;
    private $shiftStart;

    public function __construct($shiftStart, $checkInTime, $shiftName){
        $this->shiftStart = $shiftStart;
        $this->checkInTime = $checkInTime;
        $this->shift = new Shift($shiftName, $shiftStart, $checkInTime);

    }

    public function calculateLateArrival():?string{
        $arrival = new DateTime($this->checkInTime);

        //Mengambil shift berdasarkan tanggal
        $shift = $this->shift->getShiftByDate($arrival);

        if(!$shift){
            return null;
        }

        //Pastikan field 'checkInTime' ada di dalam shift
        if(!isset($shift['shiftStart'])){
            return null;
        }

        $checkInTime = new DateTime($shift['shiftStart']);

        //Menghitung keterlambatan
        if($arrival <= $checkInTime){
            return "00:00:00";
        }

        $lateArrival = $arrival->diff($checkInTime);
        return $lateArrival->format('%H:%I:%S');
    }
    public function createStatus(): string{
        $lateArrival = $this->calculateLateArrival();
        if($lateArrival == null){
            return 'Tidak ada data';
        }

        //Jika langsung dibandingkan, maka akan error. $latearrival harus diubah ke string.
        list($hour, $minute, $second) = explode(':', $lateArrival);
        $totalLateArrival = $hour * 3600 + $minute * 60 + $second;

        if($totalLateArrival > 60){
            return sprintf( 'Telat %d jam %d menit', $hour, $minute);
        }else{
            return 'Tepat waktu';
        }
    }

}
?>
