<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:20
 */

namespace User\Model;

class User
{
    public function __construct() {
        
    }
    
    public function registerUser($email,$password){
        
        $this->conn->query('INSERT INTO user WHERE u_mail = ' . $email . ' , u_pass = ' . $password);   
        
    }
}