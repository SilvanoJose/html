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
                <input type="submit" value="Atualizar">
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

                    // Função para listar as leituras
                    function listar_leituras($tabela) {
                        $con = conectar_banco();
                        $sql = "SELECT * FROM " . $tabela . 
                                " ORDER BY momento_leitura DESC";
                        $stm = $con->prepare($sql);
                        $stm->execute();
                        return $stm->fetchAll();
                    }

                    $leituras = listar_leituras("sensor_temperatura");

                    foreach ($leituras as $leitura) {
                        echo "<tr>";
                        echo "<td>" . $leitura['id'] . "</td>";
                        echo "<td>" . formatar_momento_leitura($leitura['momento_leitura']) . "</td>";
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
        echo "<div>";
        echo "<strong>Páginas:</strong> ";
        for ($i = 1; $i <= $totalPaginas; $i++) {
            echo "<a href='?pagina=$i&registrosPorPagina=$registrosPorPagina'>$i</a> ";
        }
        echo "</div>";
        ?>  
    </div> <!-- Fecha o container -->    

    <script>
    $(document).ready(function(){
        // Função para atualizar a tabela com dados do servidor
        function atualizarTabela() {
            $.ajax({
                url: 'atualizar_tabela.php', // Arquivo PHP que retorna os novos dados
                success: function(data) {
                    $('#tabelaLeituras tbody').html(data); // Atualiza o corpo da tabela com os novos dados
                }
            });
        }

        // Atualiza a tabela a cada 5 segundos
        setInterval(atualizarTabela, 5000);

        // Evento para submissão do formulário
        $('#formRegistrosPorPagina').submit(function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            // Obtém o valor selecionado
            var registrosPorPagina = $('#registrosPorPagina').val();

            // Atualiza a tabela com os novos dados
            $.ajax({
                url: 'atualizar_tabela.php',
                type: 'GET',
                data: { registrosPorPagina: registrosPorPagina },
                success: function(data) {
                    $('#tabelaLeituras tbody').html(data); // Atualiza o corpo da tabela com os novos dados
                }
            });
        });
    });
    </script>
</body>
</html>
