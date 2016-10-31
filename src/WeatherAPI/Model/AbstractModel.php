<?php

namespace WeatherAPI\Model;

abstract class AbstractModel
{
    protected $url = 'http://api.openweathermap.org/data/2.5/';
    protected $apiId = 'f977f658dc0d2961da636c8faac8e0c4';
    
    protected $data;

    protected function createUrlByCity($city, $type) {
        return $this->url . $type . '?q=' . $city . '&units=metric&appid=' . $this->apiId;
    }
    
    protected function createUrlByCoordinates($latitude, $longitude, $type) {
        return $this->url . $type . '?lat=' . $latitude . '&lon=' 
                . $longitude . '&units=metric&appid=' . $this->apiId;
    }

    protected function getJson($url) {
        $this->data = json_decode(
                file_get_contents($url), true
        );
    }   
}