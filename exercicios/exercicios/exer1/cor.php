<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cor</title>
</head>
<body>
    <h1>Escolha a cor</h1>

    <form action="cor_exec.php" method="POST">
        <select name="cor">
            <option value="Tomato">Tomato</option>
            <option value="Orange">Orange</option>
            <option value="DodgerBlue">DodgerBlue</option>
            <option value="MediumSeaGreen">MediumSeaGreen</option>
            <option value="Gray">Gray</option>
            <option value="SlateBlue">SlateBlue</option>
            <option value="Violet">Violet</option>
            <option value="LightGray">LightGray</option>
        </select>

        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>