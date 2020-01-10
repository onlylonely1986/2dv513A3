<?php

namespace model;

class Client {
    private $name;
    private $dateOfBirth;
    private $weight;
    private $goal;
    private $id;

    public function __construct($name, $dateOfBirth, $weight, $goal) {
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->weight = $weight;
        $this->goal = $goal;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getId() {
        return $this->id;
    }


}
