<?php
//Constantes para o script exibir os erros
ini_set('display_errors', 1);
error_reporting(~0);

//Constantes com os dados da conexão ao banco de dados
//Alterar essas configurações de acordo com o seu ambiente

//define("DB_HOST", 'mysql-server');
define("DB_HOST", 'localhost:3306');
define("DB_BASE", 'leituras');
define("DB_USUARIO", 'silvano');
define("DB_SENHA", 'ze5600');

//Conectar ao banco de dados
function conectar_banco() {
    $opcoes = array(
        //Define o charset da conexão
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        //Define o tipo do erro como exceção
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //Define o retorno das consultas como array associativo (campo => valor)
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    
    $con = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_BASE,
                    DB_USUARIO, DB_SENHA, $opcoes);

    return $con;
}