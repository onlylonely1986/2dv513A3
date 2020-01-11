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
        private $food;

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

        private function createTableOverClient() {
            return 
            "<b>Name:</b> " . $this->client->getName() . "
            </br><b>Birthdate:</b> " . $this->client->getBirth() . "
            </br><b>Goal:</b> " . $this->client->getGoal() . "
            </br><b>Weight:</b> " . $this->client->getWeight() . "
            </br>
            </br>
            <table style='background-color:yellow; color:black'>
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

        private function createTableOverClientExercises() {
            return 
            "
            </br>
            </br>
            <table style='background-color:yellow; color:black'>
            <tr>
                <th><b>Exercise:</b></th>
                <th><b>Weight:</b></th>
                <th><b>Repetitions:</b></th>
                <th><b>Sets:</b></th>
                <th><b>Rest:</b></th>
            </tr>
            <tr>
                <td>" . $this->exercise->getExercise() . "</td>
                <td>" . $this->exercise->getWeight() . "</td>
                <td>" . $this->exercise->getRepetitions() . "</td>
                <td>" . $this->exercise->getSets() . "</td>
                <td>" . $this->exercise->getRest() . "</td>
            </tr>
            </table>
            ";
        }


        public function echoHTML()
        {
            return "
                <h3>Client Info:</h3>
                " . $this->createTableOverClient() . "
                " . $this->createTableOverClientExercises() . "
                ";
        }

    }
