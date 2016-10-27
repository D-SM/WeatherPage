<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:12
 */

namespace App;

class MainController extends AbstractController {
    public function renderPage()
    {
        
        return $this->twig->render('main-page.twig');
    }
}