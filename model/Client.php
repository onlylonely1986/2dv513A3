<?php

namespace model;

class Client {
    private static $name;
    private static $dateOfBirth;
    private static $weight;
    private static $goal;

    public function __construct($name, $dateOfBirth, $weight, $goal) {
        self::$name = $name;
        self::$dateOfBirth = $dateOfBirth;
        self::$weight = $weight;
        self::$goal = $goal;
    }
}
