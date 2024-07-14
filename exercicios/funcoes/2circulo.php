<?php

//Funções
function pi_() {
    return 3.14159;
}

function area($raio) {
    return $raio * $raio * pi_();
}

function circunferencia($raio) {
    return 2 * $raio * pi_();
}

//Código principal
echo "<h2>Exercício 2 - Funções</h2>";

$raios = array(3, 5, 8);
foreach($raios as $circ1) {
    echo "Círculo de raio " . $circ1 . 
        " tem área de: " . area($circ1);
    echo "<br>";
    echo "Círculo de raio " . $circ1 . 
        " tem circunferência de: " . circunferencia($circ1);
    echo "<br><br>";
}