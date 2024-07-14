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