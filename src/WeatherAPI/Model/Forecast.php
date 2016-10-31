<?php

namespace WeatherAPI\Model;

class Forecast extends AbstractModel {

    public function getForecastByCityName($city) {
        $url = $this->createUrlByCity($city, 'forecast');
        $this->getJson($url);

        return $this->getForecast($this->data);
    }
    
    public function getForecastByCoordinates($latitude, $longitude) {
        $url = $this->createUrlByCoordinates($latitude, $longitude, 'forecast');
        $this->getJson($url);     
        
        return $this->getForecast($this->data);
    }    
    
    public function getForecast() {

        $tmp = [];

        foreach ($this->data['list'] as $val) {
            $tmpArray = [
                'dt' => $val['dt'],
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
