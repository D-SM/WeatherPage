<?php

/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:12
 */

namespace User;

class UserController {

 

    public function renderLoginPage() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $this->password = $password;
        $this->email = $email;
        if (!empty($email) and ! empty($password)) {
            
        } else {
            array_push($this->errorsList, "Pola mają niepoprawny format");
        }
    }

    public function renderRegisterPage() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordConfirm = filter_input(INPUT_POST, 'password-confirm', FILTER_SANITIZE_STRING);

        $this->email = $email;

        /* Walidacja inputów */
        if (!empty($email) and ! empty($password) and ! empty($passwordConfirm)) {
            if ($password === $passwordConfirm) {
                $this->registerUser($email, $password);
            } else {
                array_push($this->errorsList, "Hasła nie są takie same");
            }
        } else {
            array_push($this->errorsList, "Pola mają niepoprawny format");
        }
    }

    public function renderRememberPasswordPage() {
        
    }

    public function logout() {
        
    }

}
