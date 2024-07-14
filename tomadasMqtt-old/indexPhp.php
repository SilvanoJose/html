<?php
//Carrega o arquivo autoload.php - classe MqttClient
require("vendor/autoload.php");

//Adiciona a classe MqttClient ao script
use \PhpMqtt\Client\MqttClient;

//Conectando ao broker MQTT
$server   = 'broker.emqx.io'; //host do broquer
$port     = 1883;
$clientId = "comsumo_id";

// Conectando ao broker MQTT
$mqtt = new MqttClient($server, $port, $clientId);

// Testando a conexão
if ($mqtt->connect()) {
    echo "Conexão realizada com sucesso: " . $server . ":" . $port . "\n";
    echo "Aguardando mensagens...\n";
} else {
    echo "Falha ao conectar ao broker MQTT.\n";
    // Encerrar o script ou fazer outra ação de tratamento de erro, se necessário
    exit();
}

$ledStatus1 = null; // Inicializa a variável de status

/*
//Assinando o tópico
$qos = 0;
$topico = 'silvanojose/tomada1';
$mqtt->subscribe($topico, 
    function ($topic, $message) use (&$ledStatus1) {
      //Converter o json para array associativo
      $dados = json_decode($message, true);
      //Verificar o formato dos dados
      if (!isset($dados["status"])){
        echo "Formato de dados inválidos!\n";
        return;
      }
      //Atualizar o status
      $ledStatus1 = $dados["status"];

      // Enviar o status para a página via JavaScript
      echo "<script>";
      echo "document.getElementById('status').innerHTML = 'Status: " . ($ledStatus1 ? "Ligado" : "Desligado") . "';";
      echo "var button = document.getElementById('toggleButton');";
      echo "if (" . $ledStatus1 . ") {";
      echo "  button.innerHTML = 'Desligar Tomada 1';";
      echo "  button.style.backgroundColor = 'lightgray';";
      echo "} else {";
      echo "  button.innerHTML = 'Ligar Tomada 1';";
      echo "  button.style.backgroundColor = 'darkgray';";
      echo "}";
      echo "</script>";
    }, 
    $qos);
*/
    
//Mantém a conexão com o broquer MQTT ativa
$mqtt->loop(true);
?>