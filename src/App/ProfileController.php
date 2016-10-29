<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

class ProfileController extends AbstractController {

    public function renderPage() {

        $apiModel = new \WeatherAPI\Model\Current();
        $cities = [];
        $citiesObj = new Model\Cities();

        $userCities = $citiesObj->getCities();

        foreach ($userCities as $key) {
            $cities[] = $apiModel->getWeatherByCityName($key[1]);
        }

        $removeStatus = false;
        $addStatus = false;
       
     
        if (isset($_POST['addingCity'])) {
               
             $city = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING);
//            
           
            $addStatus = $citiesObj->addCity($id, $city);
        }s
        if (isset($_POST['removingCity'])) {
            $removeStatus = $citiesObj->deleteCity();
        }

        return $this->twig->render('profile-page.twig', [
                    'cities' => $cities,
                    'alertAddCity' => $addStatus,
                    'alertRemoveCity' => $removeStatus
        ]);
    }
}
