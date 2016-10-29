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
        $apiModel = new \WeatherAPI\Model\Current();
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
        $cities[] = $apiModel->getWeatherByCityName('warsaw');
        $cities[] = $apiModel->getWeatherByCityName('berlin');
        $cities[] = $apiModel->getWeatherByCityName('london');
        $cities[] = $apiModel->getWeatherByCityName('rome');
        $cities[] = $apiModel->getWeatherByCityName('paris');
        $cities[] = $apiModel->getWeatherByCityName('moscow');
        
        $forecast = $apiModel->getForecast('warsaw');

            return $this->twig->render('main-page.twig', [
                        'cities' => $cities,
                        'alert' => $alert,
                        'location' => $location,
                        'forecast' => $forecast
                    
            ]);
        }
    
}
