<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace WeatherAPI;

use WeatherAPI\Model\Forecast;

class ForecastController {

    private $model;

    public function __construct() {
        $this->model = new Forecast();
    }

    public function getData() {
        return '';
    }

    public function getForecastbyCityForTomorrow($city) {
        $forecastArr = $this->model->getForecastByCityName($city);
        $newArr = [];
        foreach ($forecastArr as $day) {
            if (date('d.m.Y', time() + 24 * 60 * 60) === date('d.m.Y', $day['dt'])) {
                array_push($newArr, $day);
            }
        }
        return $newArr;
    }

    // min max by day 
    
    public function getForecastByCityByDayMinMax($city) {
        $forecastArr = $this->model->getForecastByCityName($city);
        $newArr = [];
        foreach ($forecastArr as $key => $day) {
            $keyDate = explode(' ', $key)[0];
            if (!array_key_exists($keyDate, $newArr)) {
                $newArr[$keyDate] = [];
                $newArr[$keyDate]['min'] = $day['temp'];
                $newArr[$keyDate]['max'] = $day['temp'];
            } else {
                if ($day['temp'] < $newArr[$keyDate]['min']) {
                    $newArr[$keyDate]['min'] = $day['temp'];
                } else if ($day['temp'] > $newArr[$keyDate]['max']){
                    $newArr[$keyDate]['max'] = $day['temp'];
                }
            }
        }
//        echo '<pre>';
//        print_r($newArr);
//        die();
        return $newArr;
        
    }




    public function getForecastByCity5Days($city) {
        return $this->model->getForecastByCityName($city);
    }


    public function getWeeklyAverages($city) {

        $avgTemperature = 0;
        $avgPressure = 0;
        $avgHumidity = 0;
        
        $data = $this->model->getForecastByCityName($city);

        foreach ($data as $val) {
            $avgTemperature += $val['temp'];
            $avgPressure += $val['pressure'];
            $avgHumidity += $val['humidity'];
        }

        $avgTemperature = round($avgTemperature / count($this->data));
        $avgPressure = round($avgPressure / count($this->data));
        $avgHumidity = round($avgHumidity / count($this->data));

        return $averageWeather = [
            'temp' => $avgTemperature,
            'pressure' => $avgPressure,
            'humidity' => $avgHumidity
        ];
    }    
    
    
}
