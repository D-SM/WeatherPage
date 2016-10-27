<?php

namespace User;

class Auth {

    private static $salt = '#!dqwdwqD@!324fw';

    public static function sha1($password) {
        return sha1($password . self::$salt);
    }
}
