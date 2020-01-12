<?php

namespace model;

class Food 
{
    private $protein;
    private $amountprotein;
    private $carbs;
    private $amountcarbs;
    private $fat;
    private $amountfat;
    private $id;

    public function __construct($protein, $amountprotein, $carbs, $amountCarbs, $fat, $amountFat) {
        $this->protein = $protein;
        $this->amountprotein = $amountprotein;
        $this->carbs = $carbs;
        $this->amountCarbs = $amountCarbs;
        $this->fat = $fat;
        $this->amountFat = $amountFat;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getProtein() {
        return $this->protein;
    }

    public function getAmountProtein() {
        return $this->amountprotein;
    }

    public function getCarbs() {
        return $this->carbs;
    }

    public function getAmountCarbs() {
        return $this->amountCarbs;
    }

    public function getFat() {
        return $this->fat;
    }
    public function getAmountFat()
    {
        return $this->amountFat;
    }

    public function getID() {
        return $this->id;
    }

}
