<?php
require("vendor/autoload.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Bluerhinos\phpMQTT;

$server = "broker.emqx.io";     // Endereço do servidor MQTT
$port = "1883";                   // Porta do servidor MQTT
//$username = "SEU_USUARIO";        // Nome de usuário do MQTT (se necessário)
//$password = "SUA_SENHA";          // Senha do MQTT (se necessário)
//$client_id = "PHP_Client";        // ID do cliente MQTT

$mqtt = new phpMQTT($server, $port);
if(!$mqtt->connect(true, NULL)) {
    die("Falha ao conectar ao servidor MQTT..teste...");
}

if ($mqtt->connect()) {
    $topics = array(
        "silvanojose/tomada1" => array("qos" => 0),
        "silvanojose/tomada2" => array("qos" => 0),
        "silvanojose/tomada3" => array("qos" => 0),
        "silvanojose/tomada4" => array("qos" => 0)
    );

    // Inscreva-se nos tópicos
    foreach ($topics as $topic => $options) {
        $mqtt->subscribe($topic, $options['qos']);
    }

    // Loop para receber mensagens
    while ($mqtt->proc()) {
        // Lógica para atualizar as variáveis $ledStatus1, $ledStatus2, $ledStatus3 e $ledStatus4
        if ($mqtt->messages) {
            foreach ($mqtt->messages as $topic => $message) {
                switch ($topic) {
                    case "silvanojose/tomada1":
                        $ledStatus1 = intval($message);
                        break;
                    case "silvanojose/tomada2":
                        $ledStatus2 = intval($message);
                        break;
                    case "silvanojose/tomada3":
                        $ledStatus3 = intval($message);
                        break;
                    case "silvanojose/tomada4":
                        $ledStatus4 = intval($message);
                        break;
                }
            }
        }
        // Adiciona um echo para verificar se está processando
        echo "Processando mensagens MQTT...\n";
        // Permite que o servidor MQTT processe mensagens
        usleep(100000); // Aguarda 100ms para não sobrecarregar a CPU
    }

    $mqtt->close();
} else {
    echo "Falha ao conectar-se ao servidor MQTT";
}
?>