<?php
//Carrega o arquivo autoload.php - classe MqttClient
require(__DIR__ . '/../vendor/autoload.php');

//Carrega o arquivo para salvar a mensagem no banco de dados
require(__DIR__ . '/../banco/sql.php');

//Adiciona a classe MqttClient ao script
use \PhpMqtt\Client\MqttClient;

//Captura a mensagem recebida por parâmetro
$msg = "";
if(isset($argc) && $argc > 1)
    $msg = $argv[1];
else {
    echo "Nenhuma mensagem recebida para publicação!\n";
    exit;
}

//Conectando ao broker MQTT
$server   = 'broker.emqx.io'; //host do broquer
$port     = 1883;
$clientId = "publicacao_id";

$mqtt = new MqttClient($server, $port, $clientId);
$mqtt->connect();
echo "Conexão ao MQTT realizada com sucesso\n";

//Publicando a mensagem no tópico
$topico = 'silvanojose/sensor/temperatura';
$qos = 0;
$mqtt->publish($topico, $msg, $qos);
$mqtt->disconnect();

echo "Postagem no tópico [" . $topico . "] realizada com sucesso!\n";
