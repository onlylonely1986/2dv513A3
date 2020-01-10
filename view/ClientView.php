<?php


namespace view;

require_once("Messages.php");
require_once("IView.php");
require_once("model/Client.php");
// require_once("model/Exercise.php");
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
            ";
        }

        public function echoHTML()
        {
            return "
                <h3>Client Info:</h3>
                " . $this->createTableOverClient() . "
                ";
        }

    }
