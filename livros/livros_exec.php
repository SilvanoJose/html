<?php

include_once(__DIR__ . "/banco/sql_livros.php");

$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$paginas = $_POST['qtdPag'];

livros_salvar($titulo, $genero, $paginas);

echo "Livro inserido";

header(("location: livros.php"));


?>

