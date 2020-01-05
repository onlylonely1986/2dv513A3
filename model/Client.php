<?php

namespace model;

class Client {
    public $name;
    private $dateOfBirth;
    private $weight;
    private $goal;

    public function __construct($name, $dateOfBirth, $weight, $goal) {
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->weight = $weight;
        $this->goal = $goal;
    }

    public function getName() {
        return $this->name;
    }

    public function getBirth() {
        return $this->dateOfBirth;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getGoal() {
        return $this->goal;
    }
}