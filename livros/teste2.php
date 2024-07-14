<?php
require_once(__DIR__ . "/banco/conexao.php");
require_once(__DIR__ . "/banco/sql_livros.php");

if (isset($_GET['id'])) {
    $livroId = $_GET['id'];

    $livro = obterLivroPorId($livroId);

    if ($livro) {
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Detalhes do Livro</title>
    </head>
        <body>
                <h2>Detalhes do Livro</h2>
                <form>
                    ID: <input type="text" value="<?php echo $livro['id']; ?>"><br>
                    Título: <input type="text" value="<?php echo $livro['titulo']; ?>"><br>
                    Gênero: 
                    <select name="genero">
                        <option value="A" <?php echo ($livro['genero'] == 'A') ? 'selected' : ''; ?>>Ação</option>
                        <option value="C" <?php echo ($livro['genero'] == 'C') ? 'selected' : ''; ?>>Comédia</option>
                        <option value="D" <?php echo ($livro['genero'] == 'D') ? 'selected' : ''; ?>>Drama</option>
                        <option value="F" <?php echo ($livro['genero'] == 'F') ? 'selected' : ''; ?>>Ficção</option>
                        <option value="R" <?php echo ($livro['genero'] == 'R') ? 'selected' : ''; ?>>Romance</option>
                        <option value="O" <?php echo ($livro['genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                    </select><br>
                    Núm Pá: <input type="number" value="<?php echo $livro['qtd_paginas']; ?>"><br>
                </form>
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
