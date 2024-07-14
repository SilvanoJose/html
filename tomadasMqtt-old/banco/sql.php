<?php 

require_once(__DIR__ . "/conexao.php"); 

//Salvar leituras
function salvar_leitura($tabela, $momento, $valor) {
    $con = conectar_banco();

    $sql = "INSERT INTO " . $tabela . 
        " (momento_leitura, valor)" .
        " VALUES (?, ?)";

    $stm = $con->prepare($sql);
    $stm->execute(array($momento, $valor));
}

function listar_leituras($tabela) {
    $con = conectar_banco();

    $sql = "SELECT * FROM " . $tabela . 
            " ORDER BY momento_leitura DESC";

    $stm = $con->prepare($sql);
    $stm->execute();

    return $stm->fetchAll();
}

function listar_leituras_paginacao($tabela, $registrosPorPagina, $offset) {
    $con = conectar_banco();
    $sql = "SELECT * FROM " . $tabela . 
            " ORDER BY momento_leitura DESC LIMIT ? OFFSET ?";
    $stm = $con->prepare($sql);
    $stm->bindValue(1, (int)$registrosPorPagina, PDO::PARAM_INT);
    $stm->bindValue(2, (int)$offset, PDO::PARAM_INT);
    $stm->execute();
    return $stm->fetchAll();
}


function contar_registros($tabela) {
    $con = conectar_banco();
    $sql = "SELECT COUNT(*) AS total_registros FROM " . $tabela;
    $stm = $con->prepare($sql);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result['total_registros'];
}
