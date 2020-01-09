<?php


namespace view;

require_once("Messages.php");
require_once("model/Client.php");
// require_once("model/Exercise.php");
// require_once("model/Food.php");

class ClientView
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

        }

        public function echoHTML()
        {
            return "
                <p>This is the page of a specific client <b>" . $name. "</b> with the id: " . $id . " </p>
                " . $this->createTableOverClient() . "
                ";
        }

    }
