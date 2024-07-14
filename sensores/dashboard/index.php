<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/meuStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

    <!-- Começo do Footer -->
<footer class="bg-dark text-light pt-4 pb-4">
  <div class="container">
    <!-- Nav bar para inserir a cidade desejada -->
    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <form class="d-flex" id="cityForm">
        <input class="form-control me-2" type="search" placeholder="Digite a cidade" aria-label="Search" id="cityInput">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </div>
    </nav>
    <div class="row">
      <div class="col-lg-3 col-md-3">
        <h5>Cidade</h5>
        <p id="cityName">-</p>
      </div>
      <div class="col-lg-3 col-md-3">
        <h5>Temperatura</h5>
        <p id="temperature">-</p>
      </div>
      <div class="col-lg-3 col-md-3">
        <h5>Umidade</h5>
        <p id="humidity">-</p>
      </div>
      <div class="col-lg-3 col-md-3">
        <h5>Condição Clima</h5>
        <p id="weatherCondition">-</p>
      </div>
    </div>
  </div>
</footer>
<!-- Fim do Footer -->

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="meuDashboardChart.js"></script>
    <script src="meuDashboardTable.js"></script>
    <script src='weatherApi.js'></script>
    
</body>
</html>
