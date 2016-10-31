<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of searchController
 *
 * @author RENT
 */
class SearchController extends AbstractController {

    public function renderPage() {
        
            $apiModel = new \WeatherAPI\Model\CurrentWeather();
                
            if (!isset($_GET['city'])) {
                $cityToAdd = 'rome';
            } else {
                $cityToAdd = $_GET['city'];
            }

            $city = $apiModel->getCurrentWeatherByCityName($cityToAdd);

            return $this->twig->render('search-page.twig', [
            'city' => $city,
                'addingStatus' => false,
                'cityToAdd' => $cityToAdd
                
            ]);
        
    }

}
