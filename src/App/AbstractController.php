<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of AbstractController
 *
 * @author RENT
 */
class AbstractController {
    protected $twig;
    
    public function __construct($twig) {
        $this->twig = $twig;
    }
}
