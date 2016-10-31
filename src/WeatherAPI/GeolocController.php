<?php

namespace WeatherAPI;

class GeolocController {
    
    public static function getCurrentWeatherByCoordinates() {
        $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
        $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
        
        $weather = new \WeatherAPI\Model\CurrentWeather();
        $data = $weather->getCurrentWeatherByCoordinates($latitude, $longitude); 
        
        return $data;
    }
}
