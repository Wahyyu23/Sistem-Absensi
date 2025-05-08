<?php

namespace App\Console\Commands;

use App\Services\EmployeesService;
use App\Services\MqttService;
use App\Services\AttendanceService;
use App\Services\ParsingTime;
use Database\Seeders\EmployeeSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\ShiftService;
use App\Services\PermitService;
use Carbon\Carbon;

class MqttListener extends Command
{

    protected $signature = 'app:mqtt-listener';

    protected $description = 'Listen to MQTT messages....';


    protected $mqttservice;
    protected $employeeservice;
    protected $shiftservice;
    protected $permitservice;
    protected $attendanceservice;

    public function __construct(
        MqttService $mqttservice,
        AttendanceService $attendanceservice,
        EmployeesService $employeeservice,
        ShiftService $shiftservice,
        PermitService $permitservice
    ) {
        parent::__construct();

        $this->mqttservice = $mqttservice;
        $this->attendanceservice = $attendanceservice;
        $this->employeeservice = $employeeservice;
        $this->shiftservice = $shiftservice;
        $this->permitservice = $permitservice;
    }


    public function handle()
    {
        $this->mqttservice->subscribe('rfidTopic', function ($topic, $message) {
            echo "Pesan dengan topik {$topic} telah diterima: {$message}\n";

            // Pecah pesan JSON
            $data = json_decode($message, true);

            // Cek apakah data valid
            if (!$data || !isset($data['RFID_UID'], $data['Time'])) {
                echo "Data Tidak Valid\n";
                return;
            }

            $UID = $data['RFID_UID'];
            $time = $this->attendanceservice->parseIntoCarbonComplete($data['Time']);
            $onlyDate = $this->attendanceservice->parseIntoCarbonYearMonthDay($data['Time']);


            try {
                $employeeName = $this->employeeservice->getNameEmployees($UID);
            } catch (\Exception $e) {
                echo "Error ambil data pegawai: " . $e->getMessage() . "\n";
                return false;
            }
            if ($employeeName) {
                echo $employeeName->employeeName . " sudah terdaftar\n";
            } else {
                echo "Engineer dengan UID {$UID} tidak terdaftar\n";
                return;
            }
            try {
                $attendance = $this->attendanceservice->checkAttendance($UID, $onlyDate);
            } catch (\Exception $e) {
                echo "Error ambil data absensi: " . $e->getMessage() . "\n";
                return false;
            }
            if ($attendance) {
                if (is_null($attendance->checkOutTime)) {
                    echo "Sudah melakukan absensi masuk\n";

                    if (Carbon::parse($attendance->checkInTime)->diffInSeconds(Carbon::parse($time)) < 600) {
                        echo "Tap terlalu cepat. Tap diabaikan.\n";
                        return;
                    }
                    echo "Update kepulangan \n";
                    $updated = $this->attendanceservice->update(
                        $UID,
                        $onlyDate,
                        $time,
                        $this->shiftservice->getTapShift($time),
                        $this->permitservice->getPermitByEmployeeUID($UID, $onlyDate)
                    );

                    echo $updated
                        ? "Data Absensi Pulang Telah Ditambahkan\n"
                        : "Gagal menambahkan data absensi pulang\n";

                } else {
                    echo "Engineer sudah absen lengkap hari ini (masuk & pulang). Tap diabaikan.\n";
                    return;
                }
            } else {
                echo "Belum melakukan absensi masuk\n";

                $inserted = $this->attendanceservice->insert($UID, $time, $employeeName->employeeName);

                echo $inserted
                    ? "Data Absensi Masuk Telah Ditambahkan\n"
                    : "Gagal menambahkan data absensi masuk\n";
            }
        });

        $this->mqttservice->loopForever();
    }
}
