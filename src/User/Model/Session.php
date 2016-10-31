<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Model;

class Session {

    public function __construct() {
        if (session_id()) {
            session_destroy();
        } else {
            session_start();
        }
    }

    /* Zapisanie emaila użytkownika w sesji */

    public static function saveName($email) {
        $_SESSION['email'] = $email;
    }
    public static function saveID($id) {
        $_SESSION['id'] = $id;
    }
       public static function getId() {
       return $_SESSION['id'] ;
    }

    /* Pobranie emaila uzytownika z sesji */

    public static function getName() {
        if (isset($_SESSION['email'])) {
        return $_SESSION['email'];
        }
    }
//    public static function saveImg($img) {
//        $_SESSION['img'] = $img;
//    }
//       public static function getImg() {
//       return $_SESSION['img'] ;
//    }
}
