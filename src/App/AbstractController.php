<?php


namespace App;


class AbstractController {
    protected $twig;
    
    public function __construct($twig) {
        $this->twig = $twig;
    }
}
