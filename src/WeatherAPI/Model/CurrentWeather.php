<?php

namespace WeatherAPI\Model;

class CurrentWeather extends AbstractModel {

    public function getCurrentWeatherByCityName($city) {
        $url = $this->createUrlByCity($city, 'weather');
        $this->getJson($url);

        return $this->getCurrentWeather($this->data);
    }
    
    public function getCurrentWeatherByCoordinates($latitude, $longitude) {
        $url = $this->createUrlByCoordinates($latitude, $longitude, 'weather');
        $this->getJson($url);     
        
        return $this->getCurrentWeather($this->data);
    }

    private function getCurrentWeather() {
        return [
            'name' => $this->data['name'],
            'temp' => $this->data['main']['temp'],
            'pressure' => $this->data['main']['pressure'],
            'humidity' => $this->data['main']['humidity'],
            'icon' => $this->data['weather'][0]['icon'],
            'description' => $this->data['weather'][0]['description'],
            'windSpeed' => $this->data['wind']['speed'],
            'windDirection' => $this->getWindDirection($this->data['wind']['deg'])
        ];
    }
        
    private function getWindDirection($deg) {

        $windDirection = NULL;

        if ($deg >= 0 && $deg <= 22.5) {
            $windDirection = 'N';
        } elseif ($deg > 22.5 && $deg <= 67.5) {
            $windDirection = 'NE';
        } elseif ($deg > 67.5 && $deg <= 112.5) {
            $windDirection = 'E';
        } elseif ($deg > 112.5 && $deg <= 157.5) {
            $windDirection = 'SE';
        } elseif ($deg > 157.5 && $deg <= 202.5) {
            $windDirection = 'S';
        } elseif ($deg > 202.5 && $deg <= 247.5) {
            $windDirection = 'SW';
        } elseif ($deg > 247.5 && $deg <= 292.5) {
            $windDirection = 'W';
        } elseif ($deg > 292.5 && $deg <= 337.5) {
            $windDirection = 'NW';
        } elseif ($deg > 337.5 && $deg <= 360.0) {
            $windDirection = 'N';
        } else {
            $windDirection = 'Windless';
        }
        return $windDirection;
    }

}
