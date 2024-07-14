
        // Função para carregar o gráfico com os últimos registros
        function carregarGrafico() {
            $.ajax({
                url: 'meuDashboardChart.php',
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

