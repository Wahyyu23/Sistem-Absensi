<?php
namespace App\Entity;
use Illuminate\Support\Facades\DB;
use DateTime;


class Shift{
    private $id;
    private $shiftName;
    private $shiftStart;
    private $shiftEnd;
    private $startDate;
    private $endDate;

    //Deklarasi standar waktu kehadian
    public function __construct($shiftName, $shiftStart, $checkInTime){
        $this->$shiftStart;
        $this->$shiftName;
        $this->$checkInTime;

    }

    //Pengantian standar waktu kehadiran secara otomatis
    public function getShiftByDate(DateTime $date): ?object{
        //Ubah format objek Datetime menjadi format string
        $dateStr = $date->format('Y-m-d');

        //Ambil shift dari database
        $shift = DB::table('shift')
            ->where(function ($query) use ($dateStr){
                $query->where('startDate', '<=', $dateStr)
                      ->where('endDate', '>=', $dateStr);
            })
            ->orWhereNull('startDate')
            ->first();

        return $shift ?: null;
    }

    //Gettr untuk Shift
    public function getShifts(): array{
        return DB::table('shift')->get()->toArray();
    }
}

?>

