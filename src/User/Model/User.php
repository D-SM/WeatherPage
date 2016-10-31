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

        $this->conn->query('insert into user (u_mail, u_pass) values ( "' . $email . '"  , "'. \User\Auth::sha1($password) .'"  )');
    }

    public function validateUserLogin($email) {
        $result = $this->conn->query('SELECT (u_id) FROM user WHERE u_mail = "' . $email . '" ');


        if ($result->fetch_assoc()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getID($email) {
          $result = $this->conn->query('SELECT (u_id) FROM user WHERE u_mail = "' . $email . '" ');
          $id = $result->fetch_assoc();
          return $id;  
    }

    public function validateUserPassword($email, $password) {

        if ($this->validateUserLogin($email)) {
            $result = $this->conn->query('SELECT (u_pass) FROM user WHERE u_mail = "' . $email . '" ');
            $passDB = $result->fetch_assoc();

            return \User\Auth::sha1($password) === $passDB['u_pass'];
        }
        return false;
    }
    
    
    public function updatePassword($email, $password){
        
        $this->conn->query('UPDATE user set u_pass =  "'. \User\Auth::sha1($password) .'" WHERE u_mail = "'. $email .'" ');
        
    }

    public function updateHash($email, $hash) {

        if ($this->validateUserLogin($email)) {
            $this->conn->query('UPDATE user set u_reset =  "' . $hash . '", u_lifeExpectancyHash = NOW() WHERE u_mail = "' . $email .'" ');          
            return true;
        }
        
        
        return false;
    }
    public function removeHash($email){
        
        $this->conn->query('UPDATE user set u_reset = NULL WHERE u_mail = "' . $email .'" ');
    }

    public function getHash($email) {

        $result = $this->conn->query('SELECT (u_reset) FROM user WHERE u_mail = "'. $email .'" ');

        $hash = $result->fetch_assoc();

        return $hash['u_reset'];
    }
    
    public function validateUserAccount ($email) {
        
        $result = $this->conn->query('SELECT (u_acountConfirm) FROM user WHERE u_mail = "'. $email .'" ');

        $userConfirm = $result->fetch_assoc();

        return $userConfirm['u_acountConfirm'];
        
    }
    
     public function getLifeHash ($email) {
        
        $result = $this->conn->query('SELECT (u_lifeExpectancyHash) FROM user WHERE u_mail = "'. $email .'" and u_lifeExpectancyHash > NOW() - 2000 ');
        $startLifeHash = $result->fetch_assoc();

        return $startLifeHash['u_lifeExpectancyHash'];
        
    }

    
}
