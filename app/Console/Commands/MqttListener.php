<?php

namespace App\Console\Commands;

use App\Providers\MqttService;
use Illuminate\Console\Command;
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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = new MqttService();

        $mqtt->subscribe('rfidTopic', function ($topic, $message) use ($mqtt){
            echo "Pesan untuk topik $topic telah diterima: $message\n";


        $data = json_decode($message, true);

        //Simpan ke database
        DB::table('atendances')->insert([
            'employeeId' => $data['RFID_UID'],
            'date' => $data['Date'],
            'day' => $data['day'],
            'time' => $data['time'],
        ]);

        });
    }
}
