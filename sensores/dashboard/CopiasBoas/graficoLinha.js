function criarGraficoLinha(arrayDados) {
    google.charts.load('current', {
        'packages': ['line']
    });
    google.charts.setOnLoadCallback(desenharGrafico);

    function desenharGrafico() {

        var dados = new google.visualization.DataTable();
        dados.addColumn('number', 'Momento');
        dados.addColumn('number', 'Temperatura');

        dados.addRows( arrayDados );

        var opcoes = {
            chart: {
                title: 'Linha do tempo das temperaturas',
                subtitle: 'em graus Celsius (ºC)'
            },
            
            hAxis: {
                textStyle: {
                    color: '#FFFFFF'
                },
                titleTextStyle: {
                    color: '#757575'
                }
            },
            height: 350,
            width: "100%",
            legend: {
                position: 'none'
            }
        };

        var formatter = new google.visualization.NumberFormat({
            decimalSymbol: ',',
            groupingSymbol: '.',
            suffix: ' ºC'
        });
        formatter.format(dados, 1); //Aplica na segunda coluna (temperatura)

        var chart = new google.charts.Line(document.querySelector('#divGraficoLinha'));

        chart.draw(dados, google.charts.Line.convertOptions(opcoes));
    }
}