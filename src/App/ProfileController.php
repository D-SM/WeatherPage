<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of profileController
 *
 * @author RENT
 */
class ProfileController extends AbstractController{
    public function renderPage()
    {
        
        return $this->twig->render('profile-page.twig');
    }
}
