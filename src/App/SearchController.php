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
        
            $apiModel = new \WeatherAPI\Model\Current();

            if (!isset($_GET['city'])) {
                $temp = 'rome';
            } else {
                $temp = $_GET['city'];
            }

            $city = $apiModel->getWeatherByCityName($temp);

            return $this->twig->render('search-page.twig', [
            'city' => $city
            ]);
        
    }

}
