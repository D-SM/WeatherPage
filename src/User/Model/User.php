<?php

/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:20
 */

namespace User\Model;

class User extends AbstractModel {

    public function registerUser($email, $password) {

        $this->conn->query('insert into user (u_mail, u_pass) values ( "' . $email . '"  , "' . $password . '"  )');
    }

    public function validateUserLogin($email) {
        $result = $this->conn->query('SELECT (u_id) FROM user WHERE u_mail = "' . $email . '" ');
       
      
        if (!$result->fetch_assoc()) {     
            return true;
        } else {  
            return false;
        }
    }
    
}
