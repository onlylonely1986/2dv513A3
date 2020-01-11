<?php


namespace view;

require_once("Messages.php");
require_once("IView.php");
require_once("model/Client.php");
require_once("model/Exercise.php");
// require_once("model/Food.php");

class ClientView implements IView
    {
        private $clientId;
        private $clientName;
        private $client;
        private $exercise;
        private $exercises;
        private $food;
        private $foods;
        private $ex;
        private $weight;
        private $repetitions;
        private $sets;
        private $rest;

        public function __conctruct ()
        {
         
        }

        public function setClient($client) {
            $this->client = $client;
        }

        public function setExercise($exercise) {
            $this->exercise = $exercise;
        }

        public function setFood($food) {
            $this->food = $food;
        }

        public function getID() : int 
        {
            return  (int)$_SESSION['id'];
        }

        private function createTableOverClient() {
            return 
            "<b>Name:</b> " . $this->client->getName() . "
            </br><b>Birthdate:</b> " . $this->client->getBirth() . "
            </br><b>Goal:</b> " . $this->client->getGoal() . "
            </br><b>Weight:</b> " . $this->client->getWeight() . "
            </br>
            </br>
            <table style='background-color:silver; color:black'>
            <tr>
                <th><b>Name:</b></th>
                <th><b>Birthdate:</b></th>
                <th><b>Goal:</b></th>
                <th><b>Weight:</b></th>
            </tr>
            <tr>
                <td>" . $this->client->getName() . "</td>
                <td>" . $this->client->getBirth() . "</td>
                <td>" . $this->client->getGoal() . "</td>
                <td>" . $this->client->getWeight() . "</td>
            </tr>
            </table>
            ";
        }

        public function setListExercises($dataExercises) 
        {
            $this->exercises = $dataExercises;
        }

        private function createTableOverClientExercises() 
        {
            $id = $_SESSION['id'];
            $allExercises = "";

            
            $allExercises .= 
                "</br>
                <table style='background-color:aqua; color:black'>
                    <tr>
                        <th><b>Exercise:</b></th>
                        <th><b>Weight(kg):</b></th>
                        <th><b>Repetitions:</b></th>
                        <th><b>Sets:</b></th>
                        <th><b>Rest(sec):</b></th>
                    </tr>";
                
            foreach ($this->exercises as $exercise)
                {
                    if ($exercise->getID() == $id) {
                        $allExercises .= 
                        "<tr>
                            <td>" . $exercise->getExercise() . "</td>
                            <td>" . $exercise->getWeight() . "</td>
                            <td>" . $exercise->getRepetitions() . "</td>
                            <td>" . $exercise->getSets() . "</td>
                            <td>" . $exercise->getRest() . "</td>
                        </tr>";
                    }
                }
           
            $allExercises .= "</table>";
            return $allExercises;
        }

        public function setListFood($dataFood) 
        {
            $this->foods = $dataFood;
        }

        private function createTableOverClientFood() 
        {
            $id = $_SESSION['id'];
            $allFood = "";

            
            $allFood .= 
                "</br>
                <table style='background-color:aqua; color:black'>
                    <tr>
                        <th><b>Exercise:</b></th>
                        <th><b>Weight(kg):</b></th>
                        <th><b>Repetitions:</b></th>
                        <th><b>Sets:</b></th>
                        <th><b>Rest(sec):</b></th>
                    </tr>";
                
            foreach ($this->foods as $food)
                {
                    if ($food->getID() == $id) {
                        $allFood .= 
                        "<tr>
                            <td>" . $food->getProtein() . "</td>
                            <td>" . $food->getAmountProtein() . "</td>
                            <td>" . $food->getCarbs() . "</td>
                            <td>" . $food->getAmountCarbs() . "</td>
                            <td>" . $food->getFat() . "</td>
                            <td>" . $food->getAmountFat() . "</td>
                        </tr>";
                    }
                }
           
            $allFood .= "</table>";
            return $allFood;
        }

        public function echoHTML()
        {
            return "
                <h3>Client Info:</h3>
                " . $this->createTableOverClient() . "
                " . $this->createTableOverClientExercises() . "
                " . $this->createTableOverClientFood() . "
                ";
        }

    }
