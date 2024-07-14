<?php
//Carrega o arquivo autoload.php - classe MqttClient
require(__DIR__ . '/../vendor/autoload.php');

//Carrega o arquivo para salvar a mensagem no banco de dados
require(__DIR__ . '/../banco/sql.php');

//Adiciona a classe MqttClient ao script
use \PhpMqtt\Client\MqttClient;

//Conectando ao broker MQTT
$server   = 'broker.emqx.io'; //host do broquer
$port     = 1883;
$clientId = "comsumo_id";

$mqtt = new MqttClient($server, $port, $clientId);
$mqtt->connect();
echo "Conexão realizada com sucesso: " . $server . ":" . $port . "\n";
echo "Aguardando mensagens...\n";

//Assinando o tópico
$qos = 0;
$topico = 'silvanojose/sensor/temperatura';
$mqtt->subscribe($topico, 
    function ($topic, $message) {
      echo "\n";
      //echo "Mensagem recebida [" . $topic . "]: ";
      echo $message . "\n";

      //Convereter o json para array associativo
      $dados = json_decode($message, true);
      //print_r($dados);

      //Verificar o formato dos dados
      if (!isset($dados["timestamp"]) or !isset($dados["temperatura"])){
        echo "Formato de dados inválidos!\n";
        return;
      }

      //Inserir os dados no banco
      salvar_leitura("sensor_temperatura", $dados["timestamp"], $dados["temperatura"]);
      echo "Leitura salva na base de dados\n";

    }, 
    $qos);

//Mantém a conexão com o broquer MQTT ativa
$mqtt->loop(true);