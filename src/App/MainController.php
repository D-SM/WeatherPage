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

        //@todo foreach po odczytanych miastach
        
//        foreach (city as $userCities) {
//            var_dump($cities['']);
//        };
        $cities[] = $apiModel->getWeatherByCityName('warsaw');
        $cities[] = $apiModel->getWeatherByCityName('berlin');

            return $this->twig->render('main-page.twig', [
                        'cities' => $cities
            ]);
        }
    
}
