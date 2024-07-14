<?php

include_once(__DIR__ . "/../banco/conexao.php");

$conexao = conectar_banco();
print_r($conexao);