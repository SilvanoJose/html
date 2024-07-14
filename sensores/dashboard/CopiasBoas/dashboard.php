<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Lista de Leituras</title>
</head>
    <body>
    <div class="container">
    <br>
        <h2 class="bg-info text-center">Visualizações das Leituras</h2>   
    <h4>Gráficos</h2>
        <div class="row">
            <div class="col-66">    
                Conteudo da Div classe primeiro bloco
            </div>
            <div class="col-6">
                Conteudo da Div classe segundo bloco
            </div>
        </div> 
        <h4 class="mt-5">Listagem de leituras</h4>
        <table class="table table-striped table-hover" id="tabelaLeituras">
            <!-- Formulário para escolher a quantidade de registros por página -->
            <form id="formRegistrosPorPagina">
                <label for="registrosPorPagina">Registros por página:</label>
                <select name="registrosPorPagina" id="registrosPorPagina">
                    <option value="5" <?php if(isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 5) echo 'selected="selected"'; ?>>5</option>
                    <option value="10" <?php if(isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 10) echo 'selected="selected"'; ?>>10</option>
                    <option value="20" <?php if(isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 20) echo 'selected="selected"'; ?>>20</option>
                    <option value="50" <?php if(isset($_GET['registrosPorPagina']) && $_GET['registrosPorPagina'] == 50) echo 'selected="selected"'; ?>>50</option>
                </select>
                <button type="button" id="atualizarRegistros">Atualizar</button>
                <span id="totalRegistros"></span>
            </form>

            <thead>
                <tr>   
                    <th>ID</th>
                    <th>Momento da Leitura</th>
                    <th>Momento de Gravação</th>
                    <th>Valor</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                    require_once(__DIR__ . "/../banco/sql.php");

                    // Função para formatar o momento da leitura
                    function formatar_momento_leitura($timestamp) {
                        return date('d-m-Y H:i:s', $timestamp);
                    }

                    // Definindo o número padrão de registros por página
                    $registrosPorPagina = isset($_GET['registrosPorPagina']) ? $_GET['registrosPorPagina'] : 10;

                    // Recuperando o número da página atual
                    $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                    // Calculando o offset
                    $offset = ($paginaAtual - 1) * $registrosPorPagina;

                    // Obtendo os registros da página atual
                    $leituras = listar_leituras_paginacao("sensor_temperatura", $registrosPorPagina, $offset);


                    foreach ($leituras as $leitura) {
                        echo "<tr>";
                        echo "<td>" . $leitura['id'] . "</td>";
                        echo "<td>" . date('d-m-Y H:i:s', $leitura['momento_leitura']) . "</td>";
                        echo "<td>" . $leitura['momento_gravacao'] . "</td>";
                        echo "<td>" . $leitura['valor'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>        
        </table>    
        <!-- Paginação -->
        <?php
            // Obtendo o total de registros
            $totalRegistros = contar_registros("sensor_temperatura");

            // Calculando o número total de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

            // Exibindo links para páginas
            echo "<br><br>";
            echo "<div id='linksPaginacao'>";
            echo "<strong>Páginas:</strong> ";
            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<a href='?pagina=$i&registrosPorPagina=$registrosPorPagina'>$i</a> ";
            }
            echo "</div>";
        ?>  
    </div> <!-- Fecha o container -->  
    
    <script>
        $(document).ready(function(){

            // Variável global para armazenar o valor selecionado de registros por página
            var registrosPorPaginaSelecionado = $('#registrosPorPagina').val();

            // Evento de clique no botão "Atualizar"
            $('#atualizarRegistros').click(function(){
                // Obtém o valor selecionado do select
                registrosPorPaginaSelecionado = $('#registrosPorPagina').val();

                // Atualiza a tabela com o novo valor de registros por página
                atualizarTabela(registrosPorPaginaSelecionado);
            });

            // Função para atualizar a tabela com dados do servidor
            function atualizarTabela(registrosPorPaginaSelecionado) {
                console.log("Chamando atualizar_tabela.php com registrosPorPagina =", registrosPorPaginaSelecionado);

                $.ajax({
                    url: 'atualizar_tabela.php',
                    method: 'GET',
                    data: { registrosPorPagina: registrosPorPaginaSelecionado },
                    success: function(data) {
                        console.log("Dados recebidos:", data); 

                        var jsonData = JSON.parse(data);
                        // Atualiza o número total de registros
                        $('#totalRegistros').text("Total de registros: " + jsonData.totalRegistros);
                        // Limpa a tabela antes de adicionar os novos dados
                        $('#tabelaLeituras tbody').empty();


                    // Adiciona as novas linhas à tabela
                    $.each(jsonData.leituras, function(index, leitura) {
                        var newRow = "<tr><td>" + leitura.id + "</td><td>" + leitura.momento_leitura + "</td><td>" + leitura.momento_gravacao + "</td><td>" + leitura.valor + "</td></tr>";
                        $('#tabelaLeituras tbody').append(newRow);
                    });

                    // Atualiza os links de paginação
                    $('#linksPaginacao').html("Páginas: ");
                    for (var i = 1; i <= jsonData.totalPaginas; i++) {
                        var link = "<a href='?pagina=" + i + "&registrosPorPagina=" + registrosPorPaginaSelecionado + "'>" + i + "</a> ";
                        $('#linksPaginacao').append(link);
                    }

                    // Define novamente o valor da quantidade de registros por página
                    $('#registrosPorPagina').val(registrosPorPaginaSelecionado);
                },
                error: function(xhr, status, error) {
                    alert("Erro ao atualizar tabela: " + error);
                }
            });
        }

        // Função para atualizar a tabela com dados do servidor a cada 5 segundos
        setInterval(function() {
            atualizarTabela(registrosPorPaginaSelecionado);
        }, 5000);
    });

    </script>

    </body>
</html>
