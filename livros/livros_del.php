<?php

include_once(__DIR__ . "/banco/sql_livros.php");

//Recebe o ID enviado por parâmeto GET
$id = 0;
if(isset($_GET['id']))
    $id = $_GET['id'];

//Caso o parâmetro não tenha sido enviado
if($id <= 0) {
    echo "ID do livro não recebido!<br>";
    echo "<a href='livros.php'>Voltar</a>";
    exit;
}

//Excluir o livro com base no ID recebido
livros_excluir($id);

//Retornar a página de listagem dos livros
header("location: livros.php");