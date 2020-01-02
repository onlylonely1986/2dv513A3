<?php 

namespace model;

class SessionModel {
    private static $welcome = "SessionModel::welcome";
    private static $register = "SessionModel::register";
    private static $isLoggedIn = "SessionModel::isLoggedin";
    private static $username = "SessionModel::username";

    public function setWelcomeSession () {
        $_SESSION[self::$welcome] = true;
    }

    public function setUserSession ($user) {
        $_SESSION[self::$isLoggedIn] = true;
        $_SESSION[self::$username] = $user;
    }

    public function setRegisterSession () {
        $_SESSION[self::$register] = true;
    }

    public function unsetUserSession () {
        unset($_SESSION[self::$isLoggedIn]);
        unset($_SESSION[self::$username]);
    }

    public function unsetWelcomeSession () {
        unset($_SESSION[self::$welcome]);
    }

    public function unsetRegisterSession () {
        unset($_SESSION[self::$register]);
    }
}
