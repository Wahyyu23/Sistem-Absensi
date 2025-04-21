<?php

namespace App\Console\Commands;

use App\Providers\MqttService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpMqtt\Client\Facades\MQTT;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt-listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to MQTT messages....';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = new MqttService(); // Menggunakan MQTTService

        $mqtt->subscribe('rfidTopic', function ($topic, $message)
        {
            echo "Pesan dengan topik {$topic} telah diterima: {$message}\n";

            //Pecah pesan JSON
            $data = json_decode($message, true);

            //Cek apakah data valid
            if (!$data || !isset($data['RFID_UID'], $data['Date'], $data['Time']))
            {
                echo "Data Tidak Valid\n";
                return;
            }

            //Cek apakah engineer sudah terdaftar di database
            $employee = DB::table('employees')
                ->where('employeeUID', $data['RFID_UID'])
                ->first();

            if (!$employee){
                echo "Data engineer tidak ditemukan\n";
                return;
            }

            //Cek apakah absensi sudah dilakukan
            $attendance = DB::table('attendances')
                ->where('employeUID', $data['RFID_UID'])
                ->where('date', $data['Date'])
                ->where('time', $data['Time'])
                ->first();

           //Gunakan service untuk menanganani absensi

        });
    }
}


