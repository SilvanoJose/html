<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//include_once(__DIR__ . "/banco/conexao.php");
//$conn = conectar_banco();
//print_r($conn);

include_once(__DIR__ . "/banco/sql_livros.php");
$livros = livros_listar();
//print_r($livros);
//echo "<pre>" . print_r($livros, true) . "</pre>";
//echo $livros[2]['titulo'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastro de Livros</title>
</head>

<body>

    <div class="container">
        <br>
        <h2 class="bg-info text-center">Cadastro de livros</h2>

        <h4>Formulário de livros</h4>

        <div class="row">
            <div class="col-8">
                <form action="livros_exec.php" method="POST" onsubmit="return validar();">
                    <div class="form-group">
                        <label for="txtTitulo">Título</label>
                        <input type="text" id="txtTitulo" name="titulo"
                             class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="selGenero">Gênero</label>
                        <select id="selGenero" name="genero" class="form-control">
                            <option value=""></option>
                            <option value="D">Drama</option>
                            <option value="F">Ficção</option>
                            <option value="R">Romance</option>
                            <option value="O">Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numQtdPag">Quantidade de Páginas</label>
                        <input type="number" id="numQtdPag" name="qtdPag" 
                            class="form-control" style="width: 150px;" />
                    </div>

                    <button type="submit" class="btn btn-success">Gravar</button>
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </form>
            </div>

            <div class="col-4">
                <div id="divMsg" style="display: none;" class="alert alert-danger">
                </div>
            </div>
        </div>

        <h4 class="mt-5">Listagem de livros</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Gênero</th>
                    <th>Páginas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $l) : ?>
                    <tr>
                        <td><?= $l['titulo']; ?></td>
                        <td><?php
                            if ($l['genero'] == 'D')
                                echo "Drama";
                            elseif ($l['genero'] == 'F')
                                echo "Ficção";
                            elseif ($l['genero'] == 'R')
                                echo "Romance";
                            elseif ($l['genero'] == 'O')
                                echo "Outros";
                            ?></td>
                        <td><?php echo $l['qtd_paginas']; ?></td>
                        <td><a href="livros_del.php?id=<?php echo $l['id']; ?>" onclick="return confirm('Confirma a exclusão?');" class="btn btn-danger">
                                Excluir</a></td>
                        <td><a href="teste3.php?id=<?php echo $l['id']; ?>" class="btn btn-warning">
                                
                        Editar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div> <!-- Fecha o container -->

    <script src="js/validacao.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>