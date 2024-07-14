<?php
echo "<h2>Exercício 1 - Arrays</h2>";

$carros = array("Voyage", "Eclipse", "Corsa", "Fusca");
$alunos = array("Carlos", "Mehir", "Yuri", "Bruno");
$cidades = array("Foz do Iguaçu", "Chapecó", "Santa Maria", "Porto Alegre");
$estados = array("SP", "RS", "SC", "PR");

//Solução com matriz
$dados = array($carros, $alunos, $cidades, $estados);

foreach($dados as $d) {
    echo "<ul>";
    foreach($d as $v) {
        echo "<li>" . $v . "</li>";
    }
    echo "</ul>";
}

/*
//Solução com arrays
echo "<ul>";
foreach($carros as $c) {
    echo "<li>" . $c . "</li>";
}
echo "</ul>";

echo "<ul>";
foreach($alunos as $a) {
    echo "<li>" . $a . "</li>";
}
echo "</ul>";

echo "<ul>";
foreach($cidades as $c) {
    echo "<li>" . $c . "</li>";
}
echo "</ul>";

echo "<ul>";
foreach($estados as $e) {
    echo "<li>" . $e . "</li>";
}
echo "</ul>";
*/