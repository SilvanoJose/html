// Função para obter os dados meteorológicos do OpenWeatherMap
const apiKey = '1c25e81fe505234968cff6e2375491ab'; // Substitua pela sua chave da API do OpenWeatherMap

// Função para obter o nome da cidade a partir das coordenadas de latitude e longitude, e exibir as informações de tempo
function getCityFromCoordinates(lat, lon) {
    fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric&lang=pt`)
      .then(response => response.json())
      .then(data => {
        document.getElementById('cityInput').value = data.name;
        updateWeatherInfo(data); // Função para atualizar as informações do tempo no footer
      })
      .catch(error => console.log('Erro ao obter o nome da cidade:', error));
  }

// Função para atualizar as informações de tempo no footer
function updateWeatherInfo(data) {
  document.getElementById('cityName').textContent = data.name || '-';
  document.getElementById('temperature').textContent = (data.main.temp || '-') + '°C';
  document.getElementById('humidity').textContent = (data.main.humidity || '-') + '%';
  document.getElementById('weatherCondition').textContent = data.weather[0].description || '-';
}

// Evento de envio do formulário é usado para obter e mostrar os dados do tempo
document.getElementById('cityForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const city = document.getElementById('cityInput').value;
  getWeatherData(encodeURIComponent(city));
});

// Função para obter a localização do usuário e os dados de tempo da cidade atual
function getLocationAndWeather() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      getCityFromCoordinates(position.coords.latitude, position.coords.longitude);
    });
  } else {
    console.log("Geolocalização não é suportada por este navegador.");
  }
}

// Função que obtém os dados da cidade e atualiza as informações no footer
function getWeatherData(city) {
  fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=pt`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erro HTTP! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      updateWeatherInfo(data); // Atualiza as informações do tempo no footer
    })
    .catch(error => {
      console.log(error);
      alert('Falha ao recuperar informações climáticas. Por favor, tente novamente.');
    });
}

// Chama a função para obter a localização e o clima quando a página for carregada
getLocationAndWeather();