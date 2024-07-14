<html><head>
  <title>Cadastro de Usuário</title>
  <style>
  table {
  border-collapse: collapse;
  width: 100%;
  }
  th, td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  }
  th {
  background-color: #f2f2f2;
  }
  .column {
  float: left;
  width: 50%;
  }
  .row:after {
  content: '';
  display: table;
  clear: both;
  }
  </style>
  <h2>Cadastro de Usuário</h2>
  <div class='row'>
  <div class='column'>
  <h3>Registro de Usuário</h3>
  <form action='/register' method='post'>
  <label for='name'>Nome:</label><br>
  <input type='text' id='name' name='name'><br>
  <h3>Captura de Digital</h3>
  <button onclick='startFingerprintCapture()'>Iniciar Captura</button>
  <p>Estado da captura: <span id='captureStatus'>Aguardando captura...</span></p>
  <br>
  <label for='fingerprint'>Leitura da Digital:</label><br>
  <input type='text' id='fingerprint' name='fingerprint'><br><br>
  <input type='submit' value='Cadastrar'>
  </form>
  </div>
  <div class='column'>
  <h3>Captura de Infravermelho</h3>
  <button onclick='captureInfrared()'>Iniciar Captura</button>
  <p>Código do Sinal: <span id='infraredCode'></span></p>
  </div>
  </div>

  <h2>Usuários Cadastrados</h2>
  <table>
  <tr>
  <th>Nome</th>
  <th>ID da Impressão Digital</th>
  </tr>
  // Aqui você pode adicionar as linhas da tabela com os usuários cadastrados
  <tr>
  <td>Usuário 1</td>
  <td>123456789</td>
  </tr>
  <tr>
  <td>Usuário 2</td>
  <td>987654321</td>
  </tr>
  // Adicione mais linhas conforme necessário
  </table>

  <script>
  function startFingerprintCapture() {
  document.getElementById('captureStatus').innerText = 'Capturando...';
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
  document.getElementById('captureStatus').innerText = 'Aguardando captura...';
  }
  };
  xhttp.open('GET', '/startCapture', true);
  xhttp.send();
  }
  function captureInfrared() {
  document.getElementById('infraredCode').innerText = '123456';
  }
  </script>
  </body></html>)