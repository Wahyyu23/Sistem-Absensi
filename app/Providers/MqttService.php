<?php
namespace App\Providers;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttService{
    protected $client;

    public function __construct()
    {
        $server = '127.0.0.1';
        $port = 1883;
        $clientId = 'laravel-client-'.uniqid();

        $connectionSettings = (new ConnectionSettings)
            ->setUsername('null')
            ->setPassword('null')
            ->setKeepAliveInterval(60);

        $this->client = new MqttClient($server, $port, $clientId);
        $this->client->connect($connectionSettings, true);
    }

    public function publish($topic, $message)
    {
        $this->client->publish($topic, $message, MqttClient::QOS_AT_MOST_ONCE);
        $this->client->disconnect();
    }

    public function subscribe($topic, $callback)
    {
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
