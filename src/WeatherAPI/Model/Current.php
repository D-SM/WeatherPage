<?php

/**
 * 
 * User: Piotr Ratajczak
 */

namespace WeatherAPI\Model;

class Current extends AbstractModel {

    private $currentWeather;

    private function createUrl($city, $type) {
        return $this->url . $type . '?q=' . $city . '&units=metric&appid=' . $this->apiId;
    }

    public function getJason($city) {
        $this->currentWeather = json_decode(
                file_get_contents($this->createUrl($city, 'weather')), true
        );
        $this->weatherForecast = json_decode(
                file_get_contents($this->createUrl($city, 'forecast')), true
        );
    }

    public function getWeather() {




        // get jason

        return [
            'name' => $this->currentWeather['name'],
            'temp' => $this->currentWeather['main']['temp'],
            'pressure' => $this->currentWeather['main']['pressure'],
            'humidity' => $this->currentWeather['main']['humidity'],
            'description' => $this->currentWeather['weather'][0]['description'],
            'icon' => $this->currentWeather['weather'][0]['icon']
        ];
    }

}
