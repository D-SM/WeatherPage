<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace User\Model;

class Session{
    
    
    public function __construct() {
        session_start();
    }
    
    /* Zapisanie emaila użytkownika w sesji */
    public static function saveName($email){
        
        $_SESSION['email'] = $email;
        
    }
    
    /* Pobranie emaila uzytownika z sesji */
    public static function getName(){
        return $_SESSION['email'];
    }
}

