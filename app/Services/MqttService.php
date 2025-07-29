<?php
namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Illuminate\Support\Facades\Config;

class MqttService{
    protected $client;
    protected $connectionSettings;
    protected $clientId;
    protected $connected = false;


    public function __construct()
    {
        $server = env('MQTT_SERVER', '127.0.0.1');
        $port = env('MQTT_PORT', 1883);
        $username = env('MQTT_USERNAME', null);
        $password = env('MQTT_PASSWORD', null);
        //$clientId = 'laravel-client-'.uniqid();
        $this->clientId = 'laravel-client-'.uniqid();

        $connectionSettings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password)
            ->setKeepAliveInterval(60);

        $this->client = new MqttClient($server, $port, $this->clientId);
    }

    public function connect()
    {
        if(!$this->connected) {
           $this->client->connect($this->connectionSettings, true);
           $this->connected = true;
        }

        //$this->client->connect($this->connectionSettings, true);
    }

    public function disconnect()
    {
        if($this->connected){
           $this->client->disconnect();
           $this->connected = false;
        }
        //$this->client->disconnect();
    }

    public function publish($topic, $message)
    {
        // if(!$this->client->connect()){
        //     $this->connect();
        // }
        $this->connect();
        $this->client->publish($topic, $message, MqttClient::QOS_AT_MOST_ONCE);
    }


    public function subscribe($topic, $callback)
    {
        // if(!$this->client->connect()){
        //     $this->connect();
        // }
        $this->connect();
        $this->client->subscribe($topic, function ($topic, $message) use ($callback) {
        $callback($topic, $message);
        });
    }

    public function loopForever()
    {
        $this->client->loop(true);
    }
}






?>
