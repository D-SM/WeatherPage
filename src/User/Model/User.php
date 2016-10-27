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

    public function validateUser($email) {

        $result = $this->conn->query('SELECT count (u_id) as  count FROM user WHERE u_mail = ' . $email);

        //diabelek: dwa punkty wyjścia - można by dać po prostu return $result === 0
        if ($result === 0) {
            return true;
        } else {
            return false;
        }
    }

}
