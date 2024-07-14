<?php
$db_name = 'gestao';
$db_host = 'localhost';
$db_user = 'silvano';
$db_pass = 'ze5600';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);