<?php
require_once(__DIR__ . "/../banco/sql.php");

// Função para formatar o momento da leitura
function formatar_momento_leitura($timestamp) {
    return date('d-m-Y H:i:s', $timestamp);
}

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? $_GET['registrosPorPagina'] : 10;
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

$leituras = listar_leituras_paginacao("sensor_temperatura", $registrosPorPagina, $offset);
$totalRegistros = contar_registros("sensor_temperatura");

// Lógica para acessar o banco de dados e obter a última leitura
$temperaturas = listar_leituras("sensor_temperatura");
//$ultimaLeitura = $temperaturas[0]['momento_leitura'];
//echo($ultimaLeitura);

// Formatando a data e hora da última leitura
//$ultimaLeituraFormatada = date("d/m/Y à\s H:i:s", $ultimaLeitura);

// Retornando a última leitura formatada
//echo $ultimaLeituraFormatada;

echo '<input type="hidden" id="total_registros" value="' . $totalRegistros . '">';
echo '<input type="hidden" id="offset" value="' . $offset . '">';

if ($leituras) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Momento da Leitura</th><th>Momento da Gravação</th><th>Valor</th></tr>';
    foreach ($leituras as $leitura) {
        echo '<tr>';
        echo '<td>' . $leitura['id'] . '</td>';
        echo "<td>" . date('d-m-Y H:i:s', $leitura['momento_leitura']) . "</td>";
        echo '<td>' . date('d-m-Y H:i:s', strtotime($leitura['momento_gravacao'])) . '</td>';
        echo '<td>' . $leitura['valor'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Nenhuma leitura encontrada.</p>';
}
?>
