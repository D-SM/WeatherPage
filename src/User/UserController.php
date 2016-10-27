<?php

/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 26.10.16
 * Time: 08:12
 */

namespace User;

class UserController {

    public $errorsList = [];

    public function renderLoginPage() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!empty($email) and ! empty($password)) {
            $login = new Model\User();
            if ($login->validateUserPassword($email, $password)) {


                Model\Session::saveName($email);
                return true;
            } else {
                array_push($this->errorsList, "Nieporawny login lub hasło");
            }
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
        $register = new Model\User();

        if (!$register->validateUserLogin($email)) {
            if (!empty($email) and ! empty($password) and ! empty($passwordConfirm)) {
                if ($password === $passwordConfirm) {
                    $register->registerUser($email, $password);
                } else {
                    array_push($this->errorsList, "Hasła nie są takie same");
                }
            } else {
                array_push($this->errorsList, "Pola mają niepoprawny format");
            }
        } else {
            array_push($this->errorsList, "Mail już istnieje");
        }
    }

    public function renderRememberPasswordPage() {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (!empty($email)) {

            $user = new Model\User();
            if ($user->validateUserLogin($email)) {
                $randomHash = md5(rand(0, 100000) . 'sdthsfgvsuvwc5454v7hebt');
                $user->updateHash($email, $randomHash);



                $url = WEB_PATH . 'reset-pass-confirm/' . $email . '/' . $randomHash;

                $mail = new \PHPMailer();

//        $mail->SMTPDebug = 3;  

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
                $mail->Username = 'jsphppoz1mail@gmail.com';
                $mail->Password = 'Test12345';
                $mail->Port = 587;

                $mail->addAddress($email);
                $mail->isHTML(true);

                $mail->Subject = 'Przypomnienie hasła';
                $mail->Body = $url;

                $mail->send();

                return true;
            }
        }
        return false;
    }

    public function logout() {
        
    }

    public function getInputErrors() {
        return $this->errorsList;
    }

}
