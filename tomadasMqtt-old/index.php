<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Controle da Tomada</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #botaoTomada {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <button id="botaoTomada" disabled>Ligado/Desligado</button>
    <label id="statusTomada">Desconectado</label>

    <script>
        $(document).ready(function() {
            var ws = new WebSocket("ws://192.168.0.112:8080");

            ws.onopen = function() {
                console.log("Conexão WebSocket aberta.");
                // Pode solicitar o estado atual ao conectar se necessário.
                ws.send(JSON.stringify({tipo: "getEstado", topico: "silvanojose/tomada1"}));
            };

            ws.onmessage = function(event) {
                var message = JSON.parse(event.data);

                if (message.topico === "silvanojose/tomada1") {
                    var estado = message.estado; // Assuma que este seja o formato da mensagem
                    if(estado === "1") {
                        $("#botaoTomada").prop("disabled", false);
                        $("#statusTomada").text("Ligado");
                    } else if (estado === "0") {
                        $("#botaoTomada").prop("disabled", true);
                        $("#statusTomada").text("Desligado");
                    }
                }
            };

            ws.onerror = function(error) {
                console.log("Erro na conexão WebSocket.", error);
            };

            ws.onclose = function() {
                console.log("Conexão WebSocket fechada.");
            };
        });
    </script>
</body>
</html>
