<?php 
class ExternalWeatherAPI {
     public function fetchWeatherData(string $location): array {
        // Simulated response from a real API
        return [
            'location' => $location,
            'temp_celsius' => 22.5,
            'humidity' => 60
        ];
    }
}
?>