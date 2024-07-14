<?php
require("vendor/autoload.php");
use Bluerhinos\phpMQTT;

//$server = 'broker.emqx.io';
$server = '192.168.0.112';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$client_id = 'phpMQTT-subscriber'; // make sure this is unique for connecting to sever - you could use uniqid()

// Tópicos MQTT para cada tomada
$topics = array(
    "silvanojose/tomada1",
    "silvanojose/tomada2",
    "silvanojose/tomada3",
    "silvanojose/tomada4"
);

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, $username, $password)) {
    echo "Não conectado!!<br>";
    exit(1);
}

// Definir o QoS desejado para a assinatura
$qos = 0;

// Iterar sobre cada tópico e assinar
foreach ($topics as $topic) {
    $mqtt->subscribe($topic, $qos);
    echo "Tópico assinado: $topic<br>";
}

echo "Conectado ao servidor...::: $server <br>";


// Definir o callback para processar mensagens recebidas
//$mqtt->loop(true);

// Loop para verificar mensagens recebidas continuamente
// Loop para verificar mensagens MQTT recebidas
while (true) {
    // Verifica mensagens MQTT recebidas
    $messages = $mqtt->proc();

    // Verifica se existem mensagens disponíveis para processamento
    if (!empty($messages) && is_array($messages)) {
        foreach ($messages as $message) {
            // Adiciona a data e hora à mensagem recebida
            $timestamp = date('Y-m-d H:i:s'); // Obtém a data e hora atual no formato desejado
            $status = $message['message'];

            // Verifica se a mensagem é válida (0 ou 1)
            if ($status !== '0' && $status !== '1') {
                echo "Formato de dados inválido: $status\n";
                continue;
            }
            
            // Aqui você pode usar $status para determinar o estado
            // da tomada e realizar as ações necessárias, como atualizar
            // o status na interface do usuário ou executar outras operações.

            // Exemplo: Atualizar o estado da tomada com base na mensagem recebida
            $ledStatus1 = $status;

            // Exemplo: Exibir mensagem recebida com a data e hora
            echo "Mensagem recebida em $timestamp: $status\n<br>";
        }
    } else {
        // Caso não haja mensagens disponíveis para processamento
        $timestamp = date('Y-m-d H:i:s'); // Obtém a data e hora atual no formato desejado
        echo "Não há mensagens disponíveis para processamento em $timestamp.\n<br>";
    }

    // Aguarda 1 segundo antes de verificar novamente
    sleep(1);
}

// Fechar conexão MQTT (não será alcançado neste script)
$mqtt->close();


?>