<?php

namespace WeatherAPI;

class GeolocController {
    
    public static function getWeatherByCoordinates() {
        $longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
        $latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);
        
        $weather = new \WeatherAPI\Model\Current();
        $data = $weather->getWeatherByCoordinates($latitude, $longitude); 
        
        return json_encode($data);
    }
}
