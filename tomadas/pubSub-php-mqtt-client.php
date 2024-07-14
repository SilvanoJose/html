<?php

require "vendor/autoload.php";

use PhpMqtt\Client\MqttClient;

// Defina as configurações do broker MQTT
$server   = '192.168.3.124'; // host do broker
$port     = 1883;
$clientId = "cliente_php";
$topics   = ['silvanojose/tomada1'];

// Crie uma instância do cliente MQTT
$mqtt = new MqttClient($server, $port, $clientId);

// Conecte-se ao broker MQTT
$mqtt->connect();

echo "Conexão realizada com sucesso: $server:$port<br>";

// Assine os tópicos
foreach ($topics as $topic) {
    $mqtt->subscribe($topic);
    echo "Tópico assinado: $topic<br>";
}

// Loop para receber e processar mensagens
while (true) {
    echo "Dentro do while...";
    // Receba a próxima mensagem
        $message = $mqtt->receive(false);
    if ($message !== null) {
        echo "Mensagem recebida no tópico " . $message->getTopic() . ": " . $message->getMessage() . "<br>";
        // Processar a mensagem conforme necessário
    }
    echo "Dentro do while...Mensagem null";
}

// Desconecte-se do broker MQTT
echo "Saiu do while, vai desconectar";
$mqtt->disconnect();

?>
