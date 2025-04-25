<?php
namespace App\Http\Controllers;

use App\Services\MqttService;


class MqttController extends Controller
{
    public function kirimData(MqttService $mqtt)
    {
        $topic = 'rfidReply';
        $message = json_encode([
            'rfid' => '${RFID_UID}',
            'date' => '${Date}',
            'day' => '${Day}',
            'time' => '${Time}'
        ]);

        $mqtt->publish($topic, $message);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

}

?>
