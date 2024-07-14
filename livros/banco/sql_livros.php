<?php 

//    header("location: livros.php");

require_once(__DIR__ . "/conexao.php"); 

//Listar livros
function livros_listar() {
    $con = conectar_banco();

    $sql = "SELECT * FROM livros ORDER BY titulo";

    $stm = $con->prepare($sql);
    $stm->execute();

    return $stm->fetchAll();
}

//Atualizar dados de um livro
function alterar_livro($id, $titulo, $genero, $qtd_paginas) {
    $con = conectar_banco();

    try {
        // Atualiza o registro no banco de dados
        $sql = "UPDATE livros SET titulo = ?, genero = ?, qtd_paginas = ? WHERE id = ?";
        $stm = $con->prepare($sql);
        $stm->execute([$titulo, $genero, $qtd_paginas, $id]);
        // Se necessário, você pode adicionar mais verificações ou lógica aqui

    } catch (PDOException $e) {
        echo "Erro ao atualizar o livro: " . $e->getMessage();
    }
}



//Buscar livro por Id
function obterLivroPorId($idLivro) {
    $con = conectar_banco();

    $sql = "SELECT * FROM livros WHERE id = ?";

    $stm = $con->prepare($sql);
    $stm->execute(array($idLivro));

    // Retorna um único resultado, pois está buscando por ID
    return $stm->fetch();

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
