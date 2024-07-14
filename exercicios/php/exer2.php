<?php 

$soma = 0; 
for($n=1; $n<=100; $n++) {
    $soma = $soma + $n;
}

echo '<p style="color: blue;">';
echo "A soma dos algarismos de 1 a 100 é: " . $soma;
echo "</p>";

?>