/*
Para criar um servidor WebSocket que também funcione como um cliente MQTT, assinando e publicando em tópicos 
específicos recebidos de um dispositivo como o ESP32, você pode usar Node.js. Node.js é uma escolha popular 
para este tipo de tarefa porque permite lidar com operações de I/O assíncronas eficientemente, e existem 
muitas bibliotecas disponíveis para trabalhar tanto com WebSockets quanto com MQTT.
O exemplo abaixo utiliza as bibliotecas ws para o servidor WebSocket e mqtt para o cliente MQTT.

### Pré-requisitos:

Certifique-se de ter o Node.js instalado no seu sistema. Em seguida, instale as bibliotecas necessárias 
executando o seguinte comando no seu terminal:

sh
npm install ws mqtt


### Código do Servidor WebSocket e Cliente MQTT:

javascript
*/

const WebSocketServer = require('ws').Server;
const mqtt = require('mqtt');

// Configuração do servidor WebSocket
const wss = new WebSocketServer({ port: 8080 });
console.log("Servidor WebSocket rodando na porta 8080");

// Conecte-se ao broker MQTT
const client = mqtt.connect('mqtt://192.168.0.112');

const topicos = [
  'silvanojose/temperaturaBoxTomadas',
  'silvanojose/tomada1',
  'silvanojose/tomada2',
  'silvanojose/tomada3',
  'silvanojose/tomada4'
];

// Quando conectado ao MQTT, assine os tópicos
client.on('connect', () => {
  console.log("Conectado ao broker MQTT");
  topicos.forEach(topico => {
    client.subscribe(topico, err => {
      if (!err) {
        console.log(`Inscrito no tópico: ${topico}`);
      }
    });
  });
});

// Mantém um conjunto de clientes WebSocket conectados
const wsClients = new Set();

// Adiciona um cliente WebSocket à lista quando conecta
wss.on('connection', ws => {
  console.log("Cliente WebSocket conectado");
  wsClients.add(ws);

  // Remove o cliente da lista quando a conexão é fechada
  ws.on('close', () => {
    console.log("Cliente WebSocket desconectado");
    wsClients.delete(ws);
  });
});

// Quando uma mensagem é recebida via MQTT, retransmita para todos os clientes WebSocket
client.on('message', (topic, message) => {
  console.log(`Mensagem do MQTT [${topic}]: ${message.toString()}`);
  wsClients.forEach(client => {
    client.send(JSON.stringify({ topic, message: message.toString() }));
  });
});

/*
Esse servidor WebSocket estará ouvindo na porta 8080 para conexões de clientes WebSocket. Simultaneamente, 
ele conecta-se como um cliente a um broker MQTT, assina os cinco tópicos especificados e retransmite 
quaisquer mensagens recebidas por esses tópicos aos seus clientes WebSocket.

Por favor, substitua 'mqtt://enderecoDoBroker' pelo endereço do seu broker MQTT. O código acima é basicamente 
um "ponte" que traspassa mensagens do MQTT para WebSockets, permitindo a integração entre dispositivos que 
publicam mensagens MQTT (como o ESP32) e aplicações web/clientes que usam WebSockets.

*/