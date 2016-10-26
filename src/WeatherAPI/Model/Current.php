<?php

/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:22
 */

namespace WeatherAPI\Model;

class Current extends AbstractModel
{
    private $json;  

    private function createUrl($city, $type)
    {
    return $this->url . $type .'?q=' . $city . '&units=metric&appid=' . $this->apiId;
    }
    
    private function getJson($url)
    {
        $this->json = json_decode(file_get_contents($url), true);
    }    
    
    public function getWeather($city) 
    {
        $url = $this->createUrl($city, 'weather');
        $this->getJson($url);
        
        return [
            'name' => $this->json['name'],
            'temp' => $this->json['main']['temp'],
            'pressure' => $this->json['main']['pressure'],
            'humidity' => $this->json['main']['humidity'],
            'description' => $this->json['weather'][0]['description'],
            'icon' => $this->json['weather'][0]['icon']     
        ];
    }
    
    public function getForecast($city)
    {
        $url = $this->createUrl($city, 'forecast');
        $this->getJson($url);
        
        $tmp = [];
        $avg = 0;
        $avgP = 0;
        $avgH = 0;
        
        foreach($this->json['list'] as $val) {    
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
        
        $avg = $avg / count($this->json['list']);
        $avgP = $avgP / count($this->json['list']);
        $avgH = $avgH / count($this->json['list']);

        $return = [];
        $return['days'] = $tmp;
        
        $tmpArray = [
                'temp' => $avg,
                'pressure' => $avgP,
                'humidity' => $avgH
            ];
        
        $return['avg'] = $tmpArray;
        
        return $return;
    }        
}