<?php 
require_once __DIR__.'/ExternalWeatherAPI.php';
require_once __DIR__.'/WeatherAPIAdapter.php';
require_once __DIR__.'/WeatherServiceInterface.php';
function displayWeather(WeatherServiceInterface $weatherService, string $city) {
    $temp = $weatherService->getCurrentTemperature($city);
    echo "Current temperature in $city: {$temp}°C\n";
}

// Usage
$externalAPI = new ExternalWeatherAPI();
$adapter = new WeatherAPIAdapter($externalAPI);

displayWeather($adapter, 'London');

?>