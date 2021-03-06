<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;
use User\Model\Session;
class ProfileController extends AbstractController {

    public function renderPage($app) {
        
        
        if (empty(Session::getId())) {
            return $app->redirect('login');
        }
                
        $apiModel = new \WeatherAPI\Model\CurrentWeather();
        $cities = [];
        $citiesObj = new Model\Cities(\User\Model\Session::getId());

        $removeStatus = false;
        $addStatus = false;
        $existStatus = FALSE;
       
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        
        if (!empty(filter_input(INPUT_POST, 'addingCity', FILTER_SANITIZE_STRING))) {
            $addStatus = $citiesObj->addCity($city);
            
            if (!$addStatus) {
                $existStatus = true;
            }
        }
        
        if (!empty(filter_input(INPUT_POST, 'removingCity', FILTER_SANITIZE_STRING))) {
            $removeStatus = $citiesObj->deleteCity($city);
        }

        $userCities = $citiesObj->getCities();

        foreach ($userCities as $key) {
            $cities[] = $apiModel->getCurrentWeatherByCityName($key[1]);
        }
        
        return $this->twig->render('profile-page.twig', [
                    'cities' => $cities,
                    'alertAddCity' => $addStatus,
                    'alertRemoveCity' => $removeStatus,
                    'alertCityExist' => $existStatus
        ]);
    }
}
