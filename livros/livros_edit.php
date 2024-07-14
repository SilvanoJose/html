<?php
include_once(__DIR__ . "/banco/sql_livros.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $id = $_POST["id"];
   // echo("$id");
    $titulo = $_POST["titulo"];
   // echo("$$titulo");
    $genero = $_POST["genero"];
   // echo("$genero");
    $qtd_paginas = $_POST["qtd_paginas"];
   // echo("$qtd_paginas");


    try {
        // Chama a função alterar_livro
        alterar_livro($id, $titulo, $genero, $qtd_paginas);
        // Redireciona para livros.php após a operação
        header("Location: livros.php");
        exit; // Certifique-se de sair após o redirecionamento
    } catch (PDOException $e) {
        // Exibe uma mensagem de erro em caso de falha
        echo "Erro ao atualizar o livro: " . $e->getMessage();
    }


}
?>

