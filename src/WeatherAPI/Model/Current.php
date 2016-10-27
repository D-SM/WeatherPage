<?php

namespace WeatherAPI\Model;

class Current extends AbstractModel {

    private $data;

    private function createUrl($city, $type) {
        return $this->url . $type . '?q=' . $city . '&units=metric&appid=' . $this->apiId;
    }

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

        foreach ($this->data['list'] as $val) {
            $tmpArray = [
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
