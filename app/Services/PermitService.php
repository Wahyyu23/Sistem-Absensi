<?php
namespace App\Services;

use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class PermitService
{

    //Fungsi mengambil data izin dari form
    public function addPermit(Request $request)
    {
        //Validasi data
        $validatedData = $request->validate([
            'employeeUID' => 'required|string|max:255',
            'employeeName' => 'required|string|max:255',
            'attendanceId' => 'required|integer',
            'permitType' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'approvalBy' => 'nullable|string|max:255'
        ]);
        //Masukkan data ke dalam database
        $permit = Permit::create($validatedData);
        return response()->json([
            'message' => 'Data izin berhasil ditambahkan',
            'data' => $permit
        ], 201);
    }

    //Fungsi mengambil data izin dari database sesuai dengan employeeUID
    public function getPermitByEmployeeUID($employeeUID, $attendanceDate)
    {
        $permits = DB::table('permits')
                   ->where('employeeUID','=', $employeeUID)
                   ->whereDate('startDate', '<=', $attendanceDate)
                   ->whereDate('endDate', '>=', $attendanceDate)
                   ->first();
        if(!$permits)
            {
                echo "Data izin tidak ditemukan \n";
                return "Hadir";
            }else
            {
                echo "Data izin ditemukan \n";
                return $permits->permitType;
            }

    }


}














?>
























