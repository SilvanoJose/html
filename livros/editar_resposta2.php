<?php
include_once(__DIR__ . "/banco/sql_livros.php");

// Recebe o ID enviado por parâmetro GET
$id = 0;
if (isset($_GET['id']))
    $id = $_GET['id'];

// Caso o parâmetro não tenha sido enviado
if ($id <= 0) {
    echo "ID do livro não recebido!<br>";
    echo "<a href='livros.php'>Voltar</a>";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza as informações do livro no banco de dados
    $livroAtualizado = [
        'id' => $id,
        'titulo' => $_POST['titulo'],
        'genero' => $_POST['genero'],
        'qtd_paginas' => $_POST['qtd_paginas'],
    ];

    // Chama a função para atualizar o livro no banco de dados
    atualizarLivro($livroAtualizado);

    // Redireciona para a página de detalhes do livro após a edição
    header("location: detalhes_livro.php?id=" . $id);
    exit;
} else {
    // Se o formulário não foi enviado, obtém os dados do livro para preencher o formulário
    $livro = obterLivroPorId($id);

    if (!$livro) {
        echo "Livro não encontrado!<br>";
        echo "<a href='livros.php'>Voltar</a>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <form method="POST" action="">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $livro['titulo']; ?>"><br>

        <label for="genero">Gênero:</label>
        <input type="text" id="genero" name="genero" value="<?php echo $livro['genero']; ?>"><br>

        <label for="qtd_paginas">Número de Páginas:</label>
        <input type="text" id="qtd_paginas" name="qtd_paginas" value="<?php echo $livro['qtd_paginas']; ?>"><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
