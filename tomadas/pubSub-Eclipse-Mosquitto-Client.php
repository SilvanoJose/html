<?php

require "vendor/autoload.php";

use Eclipse\Mosquitto\Client;

// Defina as configurações do broker MQTT
$server   = '192.1668.3.124'; // host do broker
$port     = 1883;
$clientId = "cliente_php";
$topics   = ['silvanojose/tomada1'];

// Crie uma instância do cliente MQTT
$client = new Client($server, $port, $clientId);

// Conecte-se ao broker MQTT
$client->connect();

echo "Conexão realizada com sucesso: $server:$port\n";

// Assine os tópicos
foreach ($topics as $topic) {
    $client->subscribe($topic);
    echo "Tópico assinado: $topic\n";
}

// Loop para receber e processar mensagens
while (true) {
    $message = $client->loop();
    if ($message !== null) {
        echo "Mensagem recebida no tópico " . $message->topic . ": " . $message->payload . "\n";
        // Processar a mensagem conforme necessário
    }
}

// Desconecte-se do broker MQTT
$client->disconnect();

?>
