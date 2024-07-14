<?php
require_once(__DIR__ . "/../banco/sql.php");

//Carrega a lista de temperaturas da base de dados
$temperaturas = listar_leituras("sensor_temperatura");
//print_r($temperaturas);

//Valida se existem dados para exibir no dashboard
if(! $temperaturas) {
    echo "Sem dados para exibir!";
    exit;
}

//Gera a lista de temperaturas em ordem inversa
$temperaturasDesc = array_reverse($temperaturas)
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Dashboard de Temperatura</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-info mb-5">
            <a class="navbar-brand" href="#"><img src="../img/logo-IFPR.png" style="height: 50px; width: auto;"></a>

            <span class="mx-auto text-white" style="font-size: 20px;">Dashbord do Sensor de Temperaturas</span>
        </nav>

        <div class="row">
            <div class="col-8" id="divGraficoLinha"></div>

            <div class="col-4">
                <span class="text-muted">Última leitura: <?= date("d/m/Y à\s H:i:s", $temperaturasDesc[0]['momento_leitura']) ?></span>
                <div id="divMedidor"></div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-8">
                <div class="text-muted">Últimas 5 leituras de temperatura...</div>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Momento</th>
                            <th>Temperatura</th>
                        </tr>
                    </thead>

                    <?php foreach($temperaturasDesc as $idx => $temp): ?>
                        <tr>
                            <td><?= date("d/m/Y à\s H:i:s", $temp['momento_leitura']) ?></td>
                            <td><?= number_format($temp['valor'], 3, ",", ".") . " °C" ?></td>
                        </tr>
                        <?php if($idx == 4) break; ?>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>

    </div>

    <!-- Gráficos -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Gráfico Linha -->
    <script src="graficoLinha.js"></script>
    <script>
        var arrayDados = [
            <?php 
                foreach($temperaturas as $idx => $temp) {
                    echo "[" . ($idx+1) . ", " . $temp['valor'] . "],";
                }
            ?> ];
        criarGraficoLinha(arrayDados);
    </script>

    <!-- Gráfico de Medidor -->
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['gauge']
        });
        google.charts.setOnLoadCallback(desenharGrafico);

        function desenharGrafico() {

            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Temp.', <?= $temperaturas[0]['valor'] ?>]
            ]);

            var options = {
                width: 400,
                height: 350,
                greenFrom: 0,
                greenTo: 15,
                yellowFrom: 15,
                yellowTo: 30,
                redFrom: 30,
                redTo: 40,
                max: 40,
                minorTicks: 5,
            };

            var formatter = new google.visualization.NumberFormat({
                decimalSymbol: ',',
                groupingSymbol: '.',
                suffix: ' ºC'
            });
            formatter.format(data, 1); //Aplica na segunda coluna (temperatura)

            var chart = new google.visualization.Gauge(document.querySelector('#divMedidor'));

            chart.draw(data, options);
        }
    </script>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
