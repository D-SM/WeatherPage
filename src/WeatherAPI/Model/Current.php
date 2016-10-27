<?php

<<<<<<< HEAD
/**
 * 
 * User: Piotr Ratajczak
 */

=======
>>>>>>> 94c7c9778c5124860c6fb44c49268a1611de7f32
namespace WeatherAPI\Model;

class Current extends AbstractModel {

<<<<<<< HEAD
    private $currentWeather;
=======
    private $data;
>>>>>>> 94c7c9778c5124860c6fb44c49268a1611de7f32

    private function createUrl($city, $type) {
        return $this->url . $type . '?q=' . $city . '&units=metric&appid=' . $this->apiId;
    }
<<<<<<< HEAD
    
     // get jason


    public function getJason($city) {
        $this->currentWeather = json_decode(
                file_get_contents($this->createUrl($city, 'weather')), true
        );
        $this->weatherForecast = json_decode(
                file_get_contents($this->createUrl($city, 'forecast')), true
        );
    }

    public function getWeather() {




       
        return [
            'name' => $this->currentWeather['name'],
            'temp' => $this->currentWeather['main']['temp'],
            'pressure' => $this->currentWeather['main']['pressure'],
            'humidity' => $this->currentWeather['main']['humidity'],
            'description' => $this->currentWeather['weather'][0]['description'],
            'icon' => $this->currentWeather['weather'][0]['icon']
        ];
=======

    private function getJson($url) {
        $this->data = json_decode(
                file_get_contents($url), true
        );
    }

    public function getWeather($city) {
        $url = $this->createUrl($city, 'weather');
        
        //diabelek: getJeson zwraca coś returnem, ale nei jest to wykorzystywane nigdzie....
        $this->getJson($url);
        return [
            'name' => $this->data['name'],
            'temp' => $this->data['main']['temp'],
            'pressure' => $this->data['main']['pressure'],
            'humidity' => $this->data['main']['humidity'],
            'description' => $this->data['weather'][0]['description']
        ];
    }

    public function getForecast($city) {
        $url = $this->createUrl($city, 'forecast');
        $this->getJson($url);

        $tmp = [];
        $avg = 0;
        $avgP = 0;
        $avgH = 0;

        foreach ($this->data['list'] as $val) {
            $tmpArray = [
                'temp' => $val['main']['temp'],
                'pressure' => $val['main']['pressure'],
                'humidity' => $val['main']['humidity'],
                'icon' => $val['weather'][0]['icon'],
                'description' => $val['weather'][0]['description']
            ];

            $tmp[date('d.m.Y H:i', $val['dt'])] = $tmpArray;
            $avg += $val['main']['temp'];
            $avgP += $val['main']['pressure'];
            $avgH += $val['main']['humidity'];
        }

        $avg = $avg / count($this->data['list']);
        $avgP = $avgP / count($this->data['list']);
        $avgH = $avgH / count($this->data['list']);

        $return = [];
        $return['days'] = $tmp;

        $tmpArray = [
            'temp' => $avg,
            'pressure' => $avgP,
            'humidity' => $avgH
        ];

        $return['avg'] = $tmpArray;

        return $return;
>>>>>>> 94c7c9778c5124860c6fb44c49268a1611de7f32
    }

}
