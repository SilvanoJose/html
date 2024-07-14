<?php
require_once(__DIR__ . "/../banco/sql.php");

// Carrega a lista de todas as temperaturas da base de dados
$temperaturas = listar_leituras("sensor_temperatura");

// Valida se existem dados para retornar
if (!$temperaturas) {
    $resultado = array(
        'temperaturas' => array(),
        'ultima_leitura' => 'Sem dados para exibir!'
    );
} else {
    // Ordena as leituras em ordem decrescente de tempo
    usort($temperaturas, function($a, $b) {
        return $b['momento_leitura'] - $a['momento_leitura'];
    });

    // Extrai as últimas 5 leituras e a hora da última leitura
    $ultimas_leituras = array_slice($temperaturas, 0, 5);
    $ultima_leitura = reset($ultimas_leituras)['momento_leitura'];

    // Formata a hora da última leitura
    $ultima_leitura_formatada = date("d/m/Y à\s H:i:s", $ultima_leitura);

    // Prepara os dados para retorno em JSON
    $resultado = array(
        'temperaturas' => $ultimas_leituras,
        'ultima_leitura' => $ultima_leitura_formatada
    );
}

// Retorna os dados como JSON
header('Content-Type: application/json');
echo json_encode($resultado);
?>
