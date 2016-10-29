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
<<<<<<< HEAD
        $userCities = $citiesObj->getCities();
=======
//        $cities =$citiesObj->addCity($id);
//@todo foreach po odczytanych miastach
        $cities[] = $apiModel->getWeatherByCityName('warsaw');
        $cities[] = $apiModel->getWeatherByCityName('berlin');
        
>>>>>>> fa50961e6d8134812dabb1b4f1f1eec1a05aba88
        
        foreach ($userCities as $key) {
            $cities[] = $apiModel->getWeatherByCityName($key[1]);
        }

        $removeStatus = false;
<<<<<<< HEAD
        $addStatus = false;
        if (isset($_POST['addingCity'])) {
            $addStatus = $citiesObj->addCity();
=======
        
        if (isset($_POST['addingCity'])){
//            $addingStatus = $alertObj->addCity;
            $addingStatus = true;
>>>>>>> fa50961e6d8134812dabb1b4f1f1eec1a05aba88
        }
        if (isset($_POST['removingCity'])) {
            $removeStatus = $citiesObj->deleteCity();
        }

        return $this->twig->render('profile-page.twig', [
<<<<<<< HEAD
                    'cities' => $cities,
                    'alertAddCity' => $addStatus,
                    'alertRemoveCity' => $removeStatus
=======
            'cities' => $cities,
            'alertAddCity' => $addingStatus,
            'alertRemoveCity' => $removeStatus
            
>>>>>>> fa50961e6d8134812dabb1b4f1f1eec1a05aba88
        ]);
    }
}
