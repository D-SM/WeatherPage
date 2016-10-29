<?php

namespace WeatherAPI\Model;

class Current extends AbstractModel {

    private $data;

    private function createUrlByCity($city, $type) {
        return $this->url . $type . '?q=' . $city . '&units=metric&appid=' . $this->apiId;
    }
    
    private function createUrlByCoordinates($latitude, $longitude, $type) {
        return $this->url . $type . '?lat=' . $latitude . '&lon=' 
                . $longitude . '&units=metric&appid=' . $this->apiId;
    }

    private function getJson($url) {
        $this->data = json_decode(
                file_get_contents($url), true
        );
    }

    public function getWeatherByCityName($city) {
        $url = $this->createUrlByCity($city, 'weather');
        $this->getJson($url);

        return $this->getWeather($this->data);
    }
    
    public function getWeatherByCoordinates($latitude, $longitude) {
        $url = $this->createUrlByCoordinates($latitude, $longitude, 'weather');
        $this->getJson($url);     
        
        return $this->getWeather($this->data);
    }

    private function getWeather() {
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

    public function getForecast($city) {
        $url = $this->createUrlByCity($city, 'forecast');
        $this->getJson($url);
        

        $tmp = [];

        foreach ($this->data['list'] as $val) {
            $tmpArray = [
                'date' => date('d.m.Y H:i', $val['dt']),
                'temp' => $val['main']['temp'],
                'pressure' => $val['main']['pressure'],
                'humidity' => $val['main']['humidity'],
                'icon' => $val['weather'][0]['icon'],
                'description' => $val['weather'][0]['description']
            ];

            $tmp[date('d.m.Y H:i', $val['dt'])] = $tmpArray;
        }

        return $tmp;
    }

}
