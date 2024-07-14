<?php

require("vendor/autoload.php");
use Bluerhinos\phpMQTT;

$server = "192.168.0.112";     // Endereço do Broker MQTT
$port = 1883;                     // Porta do Broker MQTT (1883 é a porta padrão não criptografada)
$username = "seu_usuario";        // Nome de usuário para conexão (se necessário)
$password = "sua_senha";          // Senha para conexão (se necessário)
$client_id = "client-php";        // ID único para a sua conexão

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
    echo "Não conectado!!<br>";
    exit(1);
}

$topics['#'] = array("qos" => 0, "function" => "msg_receive");
$mqtt->subscribe($topics, 0);

while($mqtt->proc()){}

$mqtt->close();

function msg_receive($topic, $msg){
    echo "Msg Recebida: ".date("r")."\nTópico:{$topic}\n$msg\n";
}

// Para publicar uma mensagem, você pode usar:
// $mqtt->publish("caminho/do/tópico", "Sua mensagem", 0);

?>
