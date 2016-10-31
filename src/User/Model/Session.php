<?php

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
        return $_SESSION['email'];
    }
//    public static function saveImg($img) {
//        $_SESSION['img'] = $img;
//    }
//       public static function getImg() {
//       return $_SESSION['img'] ;
//    }
}
