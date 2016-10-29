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
        $citiesObj = new \Cities();
        $cities =$citiesObj->addCity($id);
        var_dump($cities);
//@todo foreach po odczytanych miastach
//        $cities[] = $apiModel->getWeatherByCityName('warsaw');
//        $cities[] = $apiModel->getWeatherByCityName('berlin');
        
        
        $alertObj = new Model\Cities();
// @todo odczytanie jakie miasta sa w profilu
        $addingStatus = false;
        $removeStatus = false;
        
        if (isset($_POST['addingCity'])){
            $addingStatus = $alertObj->addCity;
        }
         if (isset($_POST['removingCity'])){
            $removeStatus = $alertObj->deleteCity;
        }

        return $this->twig->render('profile-page.twig', [
                    'cities' => $cities,
                    'alertAddCity' => $addingStatus,
                    'alertRemoveCity' => $removeStatus,
            
        ]);
    }

}
