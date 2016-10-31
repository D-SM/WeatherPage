<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:19
 */

namespace WeatherAPI;

use WeatherAPI\Model\CurrentWeather;

class WeatherController implements InterfaceController

    {   
        private $data;
        
//        public function __construct($city) {
//        }

        public function getData() {
            return '';
        }
        
        
        public function getWeeklyAverages($city) {
    
        $avgTemperature = 0;
        $avgPressure = 0;
        $avgHumidity = 0;
        
            foreach ($this->data as $val) {
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
