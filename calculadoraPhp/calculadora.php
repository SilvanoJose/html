<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
    <title>Calculadora</title>
</head>
<body>
    <div class="container">
        <h2>Calculadora</h2>
        <?php
        // Inicialize as variáveis
        $valor1 = isset($_POST['valor1']) ? $_POST['valor1'] : '';
        $valor2 = isset($_POST['valor2']) ? $_POST['valor2'] : '';
        $operacao = isset($_POST['operacao']) ? $_POST['operacao'] : '';
        ?>

        <form method="post">
            Valor 1: <input type="number" value= <?= $valor1 ?> name="valor1"><br>
            Valor 2: <input type="number" value= <?= $valor2 ?> name="valor2"><br>
            Operação:
            <select name="operacao">
                <option value="soma"<?=($operacao=='soma')?'Selected':'';?> >Soma</option>
                <option value="subtracao"<?=($operacao=='subtracao')?'Selected':'';?> >Subtração</option>
                <option value="multiplicacao"<?=($operacao=='multiplicacao')?'Selected':'';?> >Multiplicação</option>
                <option value="divisao"<?=($operacao=='divisao')?'Selected':'';?> >Divisão</option>
            </select><br>
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = $_POST["valor1"];
            $valor2 = $_POST["valor2"];
            $operacao = $_POST["operacao"];

            // Verificar se os campos foram preenchidos
            if (empty($valor1) || empty($valor2)) {
                echo "Por favor, preencha todos os campos.";
            } else {
                // Validar se os valores são numéricos
                if (!is_numeric($valor1) || !is_numeric($valor2)) {
                    echo "Por favor, insira valores numéricos válidos.";
                } else {
                    // Realizar a operação selecionada
                    switch ($operacao) {
                        case "soma":
                            $resultado = $valor1 + $valor2;
                            break;
                        case "subtracao":
                            $resultado = $valor1 - $valor2;
                            break;
                        case "multiplicacao":
                            $resultado = $valor1 * $valor2;
                            break;
                        case "divisao":
                            if ($valor2 == 0) {
                                echo "Não é possível dividir por zero.";
                            } else {
                                $resultado = $valor1 / $valor2;
                            }
                            break;
                        default:
                            echo "Operação inválida.";
                    }

                    // Mostrar o resultado
                    if (isset($resultado)) {
                        echo "Resultado: " . $resultado;
                    }
                }
            }
        }
        ?>
    </div>    
</body>
</html>
