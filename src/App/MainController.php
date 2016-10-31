<?php

/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:12
 */

namespace App;

class MainController extends AbstractController {

    public function renderPage() {
        $apiCurrentWeather = new \WeatherAPI\Model\CurrentWeather();
        $apiForecast = new \WeatherAPI\ForecastController();
        
//        $citiesModel = new \Cities($id);
//        $userCities[] = $citiesModel;
        // @todo odczytanie jakie miasta sa w profilu

        $cities = [];
        $forecast = [];
        $alert = true;
        $location = false;
        //@todo foreach po odczytanych miastach
        
//        foreach (city as $userCities) {
//            var_dump($cities['']);
//        };
        $cities[] = $apiCurrentWeather->getCurrentWeatherByCityName('warsaw');
        $cities[] = $apiCurrentWeather->getCurrentWeatherByCityName('berlin');
        $cities[] = $apiCurrentWeather->getCurrentWeatherByCityName('london');
        $cities[] = $apiCurrentWeather->getCurrentWeatherByCityName('rome');
        $cities[] = $apiCurrentWeather->getCurrentWeatherByCityName('paris');
        $cities[] = $apiCurrentWeather->getCurrentWeatherByCityName('moscow');
        
        $forecast = $apiForecast->getForecastbyCityForTomorrow('warsaw');

            return $this->twig->render('main-page.twig', [
                        'cities' => $cities,
                        'alert' => $alert,
                        'location' => $location,
                        'forecast' => $forecast
                    
            ]);
        }
    
}
