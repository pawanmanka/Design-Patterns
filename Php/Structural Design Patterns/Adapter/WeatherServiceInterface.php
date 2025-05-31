<?php 

interface WeatherServiceInterface {
    public function getCurrentTemperature(string $city): float;
}
?>