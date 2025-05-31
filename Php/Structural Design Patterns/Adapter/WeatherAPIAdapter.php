<?php 
require_once __DIR__.'/WeatherServiceInterface.php';
require_once __DIR__.'/ExternalWeatherAPI.php';

class WeatherAPIAdapter implements WeatherServiceInterface {
    protected $externalAPI;

    public function __construct(ExternalWeatherAPI $externalAPI) {
        $this->externalAPI = $externalAPI;
    }

    public function  getCurrentTemperature(string $city): float {
        $data = $this->externalAPI->fetchWeatherData($city);
        return $data['temp_celsius'];
    }
}
?>