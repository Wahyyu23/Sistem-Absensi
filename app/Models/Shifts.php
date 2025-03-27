<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $table = 'shifts';

    protected $fillable = [
        'shiftId',
        'shiftStart',
        'shiftEnd',
        'startDate',
        'endDate'
    ];

    //Relasi dengan Attedance
    public function attendances(){

        return $this->hasMany(Attendance::class);
    }
}
