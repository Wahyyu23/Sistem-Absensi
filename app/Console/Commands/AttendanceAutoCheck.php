<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AttendanceAutoCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:attendance-auto-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto check attendance.....';

    /**
     *
     */
    public function handle()
    {
        $this->info('Attendance Auto Check started...');

        //Ambil data hari ini
        $today = Carbon::now()->format('Y-m-d');
        //Ambil data karyawan (employee)
        $employees = DB::table('employees')->get();


        //Ambil data karyawan (semua) dengan iterasi
        foreach ($employees as $employee) {
            $this->info("Memeriksa: {$employee->employeeName} ({$employee->employeeUID})");
            //Cek izin pada tabel kehadiran
            $attendance = DB::table('attendances')
                ->where('employeeUID', $employee->employeeUID)
                ->whereDate('checkInTime', $today)
                ->first();


            if (!$attendance) {
                $this->info("Tidak ditemukan kehadiran untuk {$employee->employeeName}");
                //Jika data tidak ditemukan, maka cek apakah ada izin di tabel izin
                try {
                    $permit = DB::table('permits')
                        ->where('employeeUID', $employee->employeeUID)
                        ->where('startDate', '<=', $today)
                        ->where('endDate', '>=', $today)
                        ->first();

                    $status = $permit->type ?? 'Alpha';

                    //Jika data izin ditemukan, maka buat/insert data kehadiran

                    DB::table('attendances')->insert([
                        'employeeUID' => $employee->employeeUID,
                        'employeeName' => $employee->employeeName,
                        'checkInTime' => null,
                        'lateArrival' => null,
                        'checkOutTime' => null,
                        //'status' => $permit->permitType,
                        'status' => $status,
                        'shiftId' => null
                    ]);

                    $this->info("Data kehadiran untuk {$employee->employeeName} pada tanggal {$today} telah ditambahkan");

                } catch (\Exception $e) {
                    echo "Error:" . $e->getMessage();
                }
            } else {
                $this->info("{$employee->employeeName} sudah punya data kehadiran");
            }
        }
    }

}
