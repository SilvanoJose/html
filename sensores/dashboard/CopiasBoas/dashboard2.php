<!DOCTYPE html>
<html>
<head>
    <title>Leituras de Sensor de Temperatura</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="graficoLinha.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagination {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <br/>
    <h2 class="bg-info text-center">Visualizações das Leituras</h2>   
    <h4>Gráficos</h2>
        <div class="row">
            <div class="col-7">    
                Conteudo da Div classe primeiro bloco
            </div>
            <div class="col-5">
                <span>Última Leitura <span id="ultima_leitura"></span> </span>
                <div id="divMedidor"></div>
            </div>
        </div> 
    <h4 class="mt-5">Listagem de leituras</h4>    
    <div class="pagination">
        <label for="registros_por_pagina">Registros por página:</label>
        <select id="registros_por_pagina">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="30">30</option>
            <option value="50">50</option>
        </select>
        <button id="btn_pagina_anterior" disabled>Anterior</button>
        <button id="btn_pagina_proxima" disabled>Próxima</button>
        <span id="total_registros"></span>
    </div>

    <div id="leituras_table">
        <!-- Tabela de leituras será carregada aqui via Ajax -->
    </div>

</div> <!-- Fecha o container -->  


<script src="dashboard.js"></script>

</body>
</html>
