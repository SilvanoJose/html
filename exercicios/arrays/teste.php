<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Livro</title>
</head>
<body>
    <form action="processar_formulario.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>

        <label for="genero">Gênero:</label>
        <input type="text" name="genero" required><br>

        <label for="qtd_paginas">Quantidade de Páginas:</label>
        <input type="number" name="qtd_paginas" required><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
