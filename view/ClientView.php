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
        // private function iterateOverClients() 
        // {
        //     $ret = "";            
        //     foreach ($this->clients as $client) 
        //     {
        //         $ret .= "<p>* <a href='?client&id=" . $client->getId() . "
        //         '>" . $client->getId() . ": " . $client->getName() . "</a></p>";
        //     }
        //     return $ret;
        // }

        private function createTableOverClientExercises() {
            $allExercises = "";
            foreach ($this->exercise as $exercises)
            {
                $allExercises .= "
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
                    <td>" . $exercises->getExercise() . "</td>
                    <td>" . $exercises->getWeight() . "</td>
                    <td>" . $exercises->getRepetitions() . "</td>
                    <td>" . $exercises->getSets() . "</td>
                    <td>" . $exercises->getRest() . "</td>
                </tr>
                </table>
                ";
            }
            return $allExercises;
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
