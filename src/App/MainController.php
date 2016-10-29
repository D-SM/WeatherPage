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
        // @todo odczytanie jakie miasta sa w profilu

        $cities = [];

        //@todo foreach po odczytanych miastach
        
            $cities[] = $apiModel->getWeather('warsaw');
            $cities[] = $apiModel->getWeather('berlin');

            return $this->twig->render('main-page.twig', [
                        'cities' => $cities
            ]);
        }
    
}
