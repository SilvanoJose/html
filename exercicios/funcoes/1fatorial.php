<?php

//Função
function fatorial($n) {
    $fat = 1;

    for($i=1; $i<=$n; $i++)
        $fat = $fat * $i;
    
    return $fat;
}

//Código principal
echo "<h2>Exercício 1 - Funções</h2>";

for($i=5; $i<=12; $i++)
    echo $i . "! = " . fatorial($i) . "<br>";