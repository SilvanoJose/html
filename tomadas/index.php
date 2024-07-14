<?php
require("vendor/autoload.php");

use Bluerhinos\phpMQTT;

$server = "broker.emqx.io";     // Endereço do servidor MQTT
$port = "1883";                   // Porta do servidor MQTT
$client_id = "PHP_Client";        // ID do cliente MQTT

$mqtt = new phpMQTT($server, $port, $client_id);
//mqtt = new phpMQTT($mqttBroker, $mqttPort, $client_id);


if ($mqtt->connect(true, NULL)) {
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema gerenciador de tomadas</title>
    <style>
        body {text-align: center;}
        .btn {padding: 10px 20px; font-size: 20px;}
        .popup {display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc;}
        .overlay {display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);}
    </style>
</head>
<body>
    <h1>Controle de Tomadas V3.2</h1>

    <p>Tomada 1 - Status: <?php echo isset($ledStatus1) ? ($ledStatus1 ? "Ligado" : "Desligado") : "Indefinido"; ?></p>
    <?php if(isset($ledStatus1)): ?>
        <button class='btn' <?php echo $ledStatus1 ? "disabled" : ""; ?> onclick='document.getElementById("action1").submit();'>Ligar Tomada 1</button>
        <button class='btn' <?php echo $ledStatus1 ? "" : "disabled"; ?> onclick='document.getElementById("action2").submit();'>Desligar Tomada 1</button>
    <?php else: ?>
        <button class='btn' disabled>Estado indefinido</button>
    <?php endif; ?>

    <!-- Repita o mesmo padrão para as outras tomadas -->

    <div class='overlay' id='overlay' onclick='hidePopup()'></div>
    <div class='popup' id='popup'>
        <p>Deseja confirmar a ação?</p>
        <button class='btn' onclick='confirmAction()'>Confirmar</button>
        <button class='btn' onclick='hidePopup()'>Cancelar</button>
    </div>

    <form id="action1" action='' method='post' style="display: none;">
        <input type='hidden' name='action' value='ligar'>
        <input type='hidden' name='tomada' value='1'>
    </form>
    <form id="action2" action='' method='post' style="display: none;">
        <input type='hidden' name='action' value='desligar'>
        <input type='hidden' name='tomada' value='1'>
    </form>

    <script>
    function showPopup(action) {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
    document.getElementById('popup').setAttribute('data-action', action);
    }
    function hidePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
    }
    function confirmAction() {
    var action = document.getElementById('popup').getAttribute('data-action');
    window.location.href = '/' + action;
    }
</script>

</body>
</html>