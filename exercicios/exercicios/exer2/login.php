<?php 
$login = "";
$senha = "";
$logado = false;
$msgErro = "";

if(isset($_POST['login']) && isset($_POST['senha'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if($login == 'ifpr' && $senha == 'posIoT')
        $logado = true;
    else
        $msgErro = "Login ou senha inválidos!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if(! $logado): ?>
        <h2>Login</h2>

        <form method="POST" action="">
            <input type="text" name="login" 
                placeholder="Informe o login" />

            <br><br>

            <input type="password" name="senha" 
                placeholder="Informe a senha"/>

            <br><br>

            <button type="submit">Logar</button>
        </form>

        <div style="color: red;"> 
            <?php echo $msgErro; ?>
        </div>
    <?php else: ?>
        <div style="color: green;"> 
            Bem-vindo a Pós IoT!
        </div>

        <a href="login.php">Sair</a>
    <?php endif;?>
</body>
</html>