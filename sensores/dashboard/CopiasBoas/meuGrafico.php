<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

    <title>Meu gráfico</title>
</head>
<body>
    <div class="container">
        <br/>
        <h2 class="bg-info text-center">Visualizações das Leituras</h2>   
        <h4>Gráficos</h4>
        <div class="row">
            <div class="col-6">   
                <span class="text-muted">Última leitura: <span id="ultima_leitura"></span></span>
            <div id="divGauge"></div>

            </div>
            <div class="col-6">
            <div id="divMedidor"></div>
    
            </div>
        </div> 
        
        <h4 class="mt-5">Tabela de leituras</h4>    
        <div>
            
        </div>
    </div> <!-- Fecha o container -->  

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // Função para carregar o gráfico com os últimos registros
        function carregarGrafico() {
            $.ajax({
                url: 'meuGraficoPHP.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Verifica se 'data' é um objeto com as chaves 'ultimasLeituras' e 'totalRegistros'
                    if (data.hasOwnProperty('ultimasLeituras') && Array.isArray(data.ultimasLeituras) && data.ultimasLeituras.length > 0) {
                        // Carrega a API do Google Charts
                        google.charts.load('current', {packages: ['corechart']});

                        // Configura a função a ser executada quando a API do Google Charts estiver carregada
                        google.charts.setOnLoadCallback(function() {
                            // Cria o DataTable com as colunas
                            var chartData = new google.visualization.DataTable();
                            chartData.addColumn('string', 'Momento da Leitura');
                            chartData.addColumn('number', 'Temperatura');

                            // Adiciona os dados ao DataTable
                            for (var i = 0; i < data.ultimasLeituras.length; i++) {
                                var momentoLeitura = data.ultimasLeituras[i].momento_leitura;
                                var temperatura = parseFloat(data.ultimasLeituras[i].valor);
                                chartData.addRow([momentoLeitura, temperatura]);
                            }

                            var options = {
                                title: 'Temperatura ao longo do tempo',
                                width: '100%', // largura do gráfico de linhas em relação ao contêiner pai
                                height: '100%', // altura do gráfico de linhas em relação ao contêiner pai
                                curveType: 'function',
                                legend: { position: 'bottom' },
                                vAxis: {
                                    title: 'Temperatura'
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('divMedidor'));
                            chart.draw(chartData, options); // Desenha o gráfico
                            
                            // Atualiza a hora da última leitura
                            $('#ultima_leitura').text(data.ultimasLeituras[0].momento_leitura);

                            // Agora, vamos carregar o medidor de temperatura
                            // Cria o medidor com o valor da última leitura
                            var temperaturaAtual = parseFloat(data.ultimasLeituras[0].valor);
                            console.log("temperaturaAtual :", temperaturaAtual);
                            carregarMedidor(temperaturaAtual);
                        });
                    } else {
                        console.error('Nenhum dado válido recebido do servidor.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar os dados do servidor:', error);
                }
            });
        }


        // Função para formatar a data e hora no formato desejado
        function formatarDataHora(dataHora) {
            var partes = dataHora.split(' '); // Divide a data e hora em partes
            var data = partes[0].split('-').reverse().join('/'); // Formata a data
            var hora = partes[1]; // Mantém a hora inalterada
            return data + ' ' + hora;
        }

        // Função para carregar o gráfico do medidor
        function carregarMedidor(valor) {

            google.charts.load('current', {'packages':['gauge']}); // Carrega apenas o pacote 'gauge'

            google.charts.setOnLoadCallback(function () {
                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Temperatura', valor]
                ]);

                var options = {
                    width: "100%", height: "100%",
                    redFrom: 90, redTo: 100,
                    yellowFrom:75, yellowTo: 90,
                    minorTicks: 5
                };

                var chart = new google.visualization.Gauge(document.getElementById('divGauge'));
                chart.draw(data, options);
            });
        }


        // Carregando o gráfico inicialmente
        carregarGrafico();

        // Atualizando o gráfico a cada 5 segundos
        setInterval(carregarGrafico, 5000);
    </script>

</body>
</html>
