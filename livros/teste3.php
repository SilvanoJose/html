<?php
require_once(__DIR__ . "/banco/conexao.php");
require_once(__DIR__ . "/banco/sql_livros.php");

if (isset($_GET['id'])) {
    $livroId = $_GET['id'];
    // Obtém os detalhes do livro a ser editado
    $livro = obterLivroPorId($livroId);

    if ($livro) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Formulário de edição de livros</title>
</head>
    <body>
        <div class="container">
        <br>
        <h2 class="bg-info text-center">Edição de Livros</h2>

        <h2>Detalhes do Livro</h2>
        <form action="livros_edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">
            Título: <input type="text" name="titulo" class="form-control" value="<?php echo $livro['titulo']; ?>"><br>
            Gênero:
            <select name="genero" class="form-control">
                <option value="A" <?php echo ($livro['genero'] == 'A') ? 'selected' : ''; ?>>Ação</option>
                <option value="C" <?php echo ($livro['genero'] == 'C') ? 'selected' : ''; ?>>Comédia</option>
                <option value="D" <?php echo ($livro['genero'] == 'D') ? 'selected' : ''; ?>>Drama</option>
                <option value="F" <?php echo ($livro['genero'] == 'F') ? 'selected' : ''; ?>>Ficção</option>
                <option value="R" <?php echo ($livro['genero'] == 'R') ? 'selected' : ''; ?>>Romance</option>
                <option value="O" <?php echo ($livro['genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
            </select><br>
            Núm Páginas: <input class="form-control" type="number" name="qtd_paginas" value="<?php echo $livro['qtd_paginas']; ?>"><br>
            
            <input type="submit" value="Salvar" class="btn btn-warning">
            <a href="livros.php" class="btn btn-secondary">Voltar p/ Lista</a>
        </form>

        </div> <!-- Fecha o container -->

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
    </body>
</html>
<?php
    } else {
        echo "Nenhum livro encontrado com o ID fornecido.";
    }
} else {
    echo "ID não fornecido na URL.";
}
?>
