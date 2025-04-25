<?php

namespace App\Services;
use App\Models\Shifts;
use Carbon\Carbon;
use App\Entity\Shift;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Node\StringContainerHelper;


class ShiftService
{

    public function getTapShift($tapTime): string{
    {
        $tapTime =Carbon::parse($tapTime);

        //Ambil data shift dari Model/Database
        $shifts = Shifts::all();

        //Looping data shift
        foreach ($shifts as $shift) {
            //Periksa apakah tap masuk ke dalam rentang waktu shift
            $startDate = Carbon::parse($shift->startDate);
            $endDate = Carbon::parse($shift->endDate);

            //Shift tidak lintas hari
            if($startDate <= $endDate){
                if ($tapTime->between($startDate, $endDate)){
                    return $shift->shiftId;
                }
            }else{
                //Shift Lintas Hari
                if($tapTime>= $startDate || $tapTime <= $endDate){
                    return $shift->shiftId;
                }
            }
        }

    }
       return $shift->shiftId(2); //Jika tidak ada shift yang cocok
  }
}

?>
