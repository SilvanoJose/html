<?php 

require_once(__DIR__ . "/conexao.php"); 

//Listar livros
function livros_listar() {
    $con = conectar_banco();

    $sql = "SELECT * FROM livros ORDER BY titulo";

    $stm = $con->prepare($sql);
    $stm->execute();

    return $stm->fetchAll();
}

//Inserir livros
function livros_salvar($titulo, $genero, $qtdPag) {
    $con = conectar_banco();

    $sql = "INSERT INTO livros (titulo, genero, qtd_paginas)
            VALUES (?, ?, ?)";

    $stm = $con->prepare($sql);
    $stm->execute(array($titulo, $genero, $qtdPag));
}

//Excluir livros
function livros_excluir($idLivro) {
    $con = conectar_banco();

    $sql = "DELETE FROM livros WHERE id = ?";

    $stm = $con->prepare($sql);
    $stm->execute(array($idLivro));
}
