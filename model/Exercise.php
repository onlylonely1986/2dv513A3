<?php

namespace model;

class Exercise
{
    private $exercise;
    private $weight;
    private $repetitions;
    private $sets;
    private $rest;
    private $id;

    public function __construct($exercise, $weight, $repetitions, $sets, $rest) {
        $this->exercise = $exercise;
        $this->weight = $weight;
        $this->repetitions = $repetitions;
        $this->sets = $sets;
        $this->rest = $rest;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getExercise() {
        return $this->exercise;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getRepetitions() {
        return $this->repetitions;
    }

    public function getSets() {
        return $this->sets;
    }

    public function getRest() {
        return $this->rest;
    }

    public function getID() {
        return $this->id;
    }
}