<?php
// Incluir arquivo de funções para manipulação do banco de dados
include_once(__DIR__ . "/banco/sql_livros.php");

//Recebe o ID enviado por parâmeto GET
if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    // Obtém os detalhes do livro a ser editado
    $livro = obterLivroPorId($livroId);

    if ($livro) {
}

// Obtém as informações do livro com base no ID
$livro = obterLivroPorId($id);
echo "Depois de executar obterLivroPorId :";
print_r($livro);

// Verifica se o livro foi encontrado
if (!$livro) {
    print_r("Dentro da verificação se livro foi encontrado!!");
    echo "Livro não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Edição de Livros</title>
</head>
<body>
<div class="container">
        <br>
        <h2 class="bg-info text-center">Edição de Livros</h2>

        <h4>Formulário de edição de livros</h4>
        <div class="row">
            <div class="col-8">
                <form action="livros_exec.php" method="POST" onsubmit="return validar();">
                    <div class="form-group">
                        <label for="txtTitulo">Título</label>
                        <input type="text" id="txtTitulo" name="titulo"
                             class="form-control" value="<?= $livro['titulo']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="selGenero">Gênero</label>
                        <select id="selGenero" name="genero" class="form-control">
                            <option value=""></option>
                            <option value="D" <?php echo ($livro['genero'] == 'D') ? 'selected' : ''; ?>>Drama</option>
                            <option value="F" <?php echo ($livro['genero'] == 'F') ? 'selected' : ''; ?>>Ficção</option>
                            <option value="R" <?php echo ($livro['genero'] == 'R') ? 'selected' : ''; ?>>Romance</option>
                            <option value="O" <?php echo ($livro['genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numQtdPag">Quantidade de Páginas</label>
                        <input type="number" id="numQtdPag" name="qtdPag" 
                            class="form-control" style="width: 150px;" value="<?= $livro['qtd_paginas']; ?>"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submit" name="submit" class="form-control"/>
                    </div>

                </form>
            </div>

            <div class="col-4">
                <div id="divMsg" style="display: none;" class="alert alert-danger">
                </div>
            </div>
        </div>

        <!-- Adicione um link para a página de edição com o ID do livro -->
        <a href="livros_edit.php?id=<?= $livro['id']; ?>" class="btn btn-warning">Salvar edição</a>

        <a href="livros.php" class="btn btn-secondary">Voltar p/ Lista</a>
 
    </div> <!-- Fecha o container -->


 
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
