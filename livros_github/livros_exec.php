<?php

include_once(__DIR__ . "/banco/sql_livros.php");

$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$paginas = $_POST['qtdPag'];

livros_salvar($titulo, $genero, $paginas);

header("location: livros.php");