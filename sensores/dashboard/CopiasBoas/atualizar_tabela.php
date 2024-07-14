<?php
// Incluir o arquivo com as funções do banco de dados
require_once(__DIR__ . "/../banco/sql.php");

// Função para formatar o momento da leitura
function formatar_momento_leitura($timestamp) {
    return date('d-m-Y H:i:s', $timestamp);
}

// Parâmetros de paginação
$registrosPorPagina = isset($_GET['registrosPorPagina']) ? $_GET['registrosPorPagina'] : 5;
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Obter as leituras para a página atual
$offset = ($paginaAtual - 1) * $registrosPorPagina;
$leituras = listar_leituras_paginacao("sensor_temperatura", $registrosPorPagina, $offset);

// Total de registros e páginas
$totalRegistros = contar_registros("sensor_temperatura");
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Construir um array com os dados das leituras
$dadosLeituras = array();
foreach ($leituras as $leitura) {
    $dadosLeituras[] = array(
        'id' => $leitura['id'],
        'momento_leitura' => formatar_momento_leitura($leitura['momento_leitura']),
        'momento_gravacao' => $leitura['momento_gravacao'],
        'valor' => $leitura['valor']
    );
}

// Retornar os dados no formato JSON, incluindo informações sobre a paginação
echo json_encode(array(
    'leituras' => $dadosLeituras,
    'totalPaginas' => $totalPaginas,
    'paginaAtual' => $paginaAtual,
    'registrosPorPagina' => $registrosPorPagina, // Incluímos o valor selecionado para a quantidade de registros por página
    'totalRegistros' => $totalRegistros
));
?>
