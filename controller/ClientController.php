<?php

namespace controller;

require_once("model/Client.php");
require_once("controller/States.php");

class ClientController {
    private $searchView;
    private $addNewClientView;
    private $clientView;
    private $storage;
    private $session;
    private $newClient;
    private $client;
    private $exercises;
    private $food;

    public function __construct(\view\SearchView $searchView, \view\AddNewClientView $addNewClientView, \view\ClientView $clientView, \model\ClientStorage $storage, \model\SessionModel $session) {
        $this->searchView = $searchView;
        $this->addNewClientView = $addNewClientView;
        $this->clientView = $clientView;
        $this->storage = $storage;
        $this->session = $session;
    }

    public function getState() {
        if ($this->pickedClient()) {
            // vald client spara i session
            // hämta all info från storage
            // skicka med till clientview
            $id = substr($_SERVER['REQUEST_URI'], -1);
            // Set session variables
            $_SESSION["pickedClientId"] = $id;
            $this->client = $this->storage->getClientInfo($id);
            $this->exercises = $this->storage->getClientExercises($id);
            $this->food = $this->storage->getClientFood($id);
            $this->clientView->setClient($this->client);
            $this->clientView->setExercise($this->exercises);
            $this->clientView->setFood($this->food);
            return States::$pickClient;
        } else if($this->registerNewExercise()) {
            // hämta info från exerciseview
            // kontrollera info
            // spara i storage
            // skicka med message till clientInfoView
            // hämta uppdaterad info från storage
            // uppdatera clientInfoview
            return States::$newExercise;
        } else if($this->registerNewFood()) {
            // hämta info från foodview
            // kontrollera info
            // spara i storage
            // skicka med message till clientInfoView
            // hämta uppdaterad info från storage
            // uppdatera clientInfoview
            return States::$newFood;
        } else if ($this->registerNewClient()) {
            // hämta info från clientview
            // kontrollera info
            // spara i storage
            // skicka med message till clientInfoView
            // hämta uppdaterad info från storage
            // uppdatera clientInfoview
            return States::$newClient;
        } else if ($this->newSearch()) {
            // hämta info från searchview
            // hämta info från storage
            // skicka message till searchview
            // hämta från storage
            // rendera lista med sökförslag
            return States::$newSearch;
        } else {
            return;
        }
    }

    public function pickedClient() : bool 
    {
        if ($this->searchView->getRequest()) 
        {
            $id = substr($_SERVER['REQUEST_URI'], -1);
            echo "id is: " . $id . "  .. ";
            return true;
        }
        
        return false;
    }

    public function registerNewExercise() : bool {
        return false;
    }

    public function registerNewFood() : bool {
        return false;
    }

    public function registerNewClient() : bool {
        return false;
    }

    public function newSearch() : bool {
        return false;
    }

    public function addNewClient() {
        if($this->AddNewClientView->wantsToSaveNewClient()) {
            if ($this->AddNewClientView->isAllFieldsFilled()) {
                $user = $this->AddNewClientView->returnNewClientName();
                $dateOfBirth = $this->AddNewClientView->returnNewClientDateOfBirth();
                $weight = $this->AddNewClientView->returnNewClientWeight();
                $goal = $this->AddNewClientView->returnNewClientGoal();
                $this->storage->saveNewClientToDB($this->setNewClient($user, $dateOfBirth, $weight, $goal));
                $this->AddNewClientView->message();                    
            }
            
        }
    }

    private function setNewClient($name, $dateOfBirth, $weight, $goal) {
       $this->client = new \model\Client($name, $dateOfBirth, $weight, $goal);
    }
}
