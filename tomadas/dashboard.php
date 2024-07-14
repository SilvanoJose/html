<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema gerenciador de tomadas</title>
    <style>
        body {text-align: center;}
        .btn {padding: 10px 20px; font-size: 20px;}
        .popup {display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid #ccc;}
        .overlay {display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);}
      </style>
</head>
<body>
    <h1>Controle de Tomadas V3.2</h1>

    <p>Tomada 1 - Status: <?php echo isset($ledStatus1) ? ($ledStatus1 ? "Ligado" : "Desligado") : "Indefinido"; ?></p>
    <?php if(isset($ledStatus1)): ?>
        <button class='btn' <?php echo $ledStatus1 ? "disabled" : ""; ?> onclick='document.getElementById("action1").submit();'>Ligar Tomada 1</button>
        <button class='btn' <?php echo $ledStatus1 ? "" : "disabled"; ?> onclick='document.getElementById("action2").submit();'>Desligar Tomada 1</button>
    <?php else: ?>
        <button class='btn' disabled>Estado indefinido</button>
    <?php endif; ?>

    <p>Tomada 2 - Status: <?php echo $ledStatus2 ? "Ligado" : "Desligado"; ?></p>
        <?php if($ledStatus2): ?>
            <button class='btn' disabled>Ligar Tomada 2</button>
        <?php else: ?>
            <button class='btn' onclick='showPopup("ligar2")'>Ligar Tomada 2</button>
        <?php endif; ?>
        <?php if($ledStatus2): ?>
            <button class='btn' onclick='showPopup("desligar2")'>Desligar Tomada 2</button>
        <?php else: ?>
            <button class='btn' disabled>Desligar Tomada 2</button>
    <?php endif; ?>

    <p>Tomada 3 - Status: <?php echo $ledStatus3 ? "Ligado" : "Desligado"; ?></p>
        <?php if($ledStatus3): ?>
            <button class='btn' disabled>Ligar Tomada 3</button>
        <?php else: ?>
            <button class='btn' onclick='showPopup("ligar3")'>Ligar Tomada 3</button>
        <?php endif; ?>
        <?php if($ledStatus3): ?>
            <button class='btn' onclick='showPopup("desligar3")'>Desligar Tomada 3</button>
        <?php else: ?>
            <button class='btn' disabled>Desligar Tomada 3</button>
        <?php endif; ?>

    <p>Tomada 4 - Status: <?php echo $ledStatus4 ? "Ligado" : "Desligado"; ?></p>
        <?php if($ledStatus4): ?>
            <button class='btn' disabled>Ligar Tomada 4</button>
        <?php else: ?>
            <button class='btn' onclick='showPopup("ligar4")'>Ligar Tomada 4</button>
        <?php endif; ?>
        <?php if($ledStatus4): ?>
            <button class='btn' onclick='showPopup("desligar4")'>Desligar Tomada 4</button>
        <?php else: ?>
            <button class='btn' disabled>Desligar Tomada 4</button>
        <?php endif; ?>

    <!-- Adicionando o texto da temperatura -->
    <p class='temperature'>Temperatura: <?php echo $temperature; ?> °C</p>

    <h1>Cadastro de horários de acionamentos</h1>

    <form action='/cadastrarHorarios' method='post'>
        <label for='dayOfWeek'>Dia da semana:</label>
            <select id='dayOfWeek' name='dayOfWeek'>
            <option value='0'>Domingo</option>
            <option value='1'>Segunda-feira</option>
            <option value='2'>Terça-feira</option>
            <option value='3'>Quarta-feira</option>
            <option value='4'>Quinta-feira</option>
            <option value='5'>Sexta-feira</option>
            <option value='6'>Sábado</option>
            </select><br><br>
        <label for='hourOn'>Hora de ligar:</label>
        <input type='number' id='hourOn' name='hourOn' min='0' max='23' required>
            <label for='minuteOn'>Minuto de ligar:</label>
        <input type='number' id='minuteOn' name='minuteOn' min='0' max='59' required><br><br>
            <label for='hourOff'>Hora de desligar:</label>
        <input type='number' id='hourOff' name='hourOff' min='0' max='23' required>
            <label for='minuteOff'>Minuto de desligar:</label>
        <input type='number' id='minuteOff' name='minuteOff' min='0' max='59' required><br><br>
            <button class='btn' type='submit'>Cadastrar Horário</button>

        <div class='overlay' id='overlay' onclick='hidePopup()'></div>
        <div class='popup' id='popup'>
            <p>Deseja confirmar a ação?</p>
            <button class='btn' onclick='confirmAction()'>Confirmar</button>
            <button class='btn' onclick='hidePopup()'>Cancelar</button>
        </div>
    </form>        
<script>
    function showPopup(action) {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
    document.getElementById('popup').setAttribute('data-action', action);
    }
    function hidePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
    }
    function confirmAction() {
    var action = document.getElementById('popup').getAttribute('data-action');
    window.location.href = '/' + action;
    }
</script>

</body>
</html>
