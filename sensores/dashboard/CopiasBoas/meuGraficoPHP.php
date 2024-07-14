<?php
require_once(__DIR__ . "/../banco/sql.php");

// Função para formatar o momento da leitura
function formatar_momento_leitura($timestamp) {
    return date('d-m-Y H:i:s', $timestamp);
}

// Obtendo as últimas 5 leituras ordenadas por momento de leitura (a mais recente primeiro)
$temperaturas = listar_leituras("sensor_temperatura");
$ultimasLeituras = array_slice($temperaturas, 0, 5);
usort($ultimasLeituras, function($a, $b) {
    return $b['momento_leitura'] - $a['momento_leitura'];
});

// Formatando as datas das últimas leituras
foreach ($ultimasLeituras as &$leitura) {
    $leitura['momento_leitura'] = formatar_momento_leitura($leitura['momento_leitura']);
}

// Montando os dados em formato JSON
$data = array(
    'ultimasLeituras' => $ultimasLeituras,
    'totalRegistros' => contar_registros("sensor_temperatura")
);

// Retornando os dados como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
