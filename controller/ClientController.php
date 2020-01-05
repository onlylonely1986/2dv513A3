<?php

namespace controller;

require_once("model/Client.php");

class ClientController {
    private $searchView;
    private $clientView;
    private $storage;
    private $session;
    private $newClient;

    public function __construct(\view\SearchView $searchView, \view\ClientView $clientView, \model\ClientStorage $storage, \model\SessionModel $session) {
        $this->searchView = $searchView;
        $this->clientView = $clientView;
        $this->storage = $storage;
        $this->session = $session;
    }

    public function searchForClient() {

    }

    public function addNewClient() {
        if($this->clientView->wantsToSaveNewClient()) {
            if ($this->clientView->isAllFieldsFilled()) {
                $user = $this->clientView->returnNewClientName();
                $dateOfBirth = $this->clientView->returnNewClientDateOfBirth();
                $weight = $this->clientView->returnNewClientWeight();
                $goal = $this->clientView->returnNewClientGoal();
                $this->storage->saveNewClientToDB($this->setNewClient($user, $dateOfBirth, $weight, $goal));
                $this->clientView->message();                    
            }
            
        }
    }


    private function setNewClient($name, $dateOfBirth, $weight, $goal) {
        return new \model\Client($name, $dateOfBirth, $weight, $goal);
    }
}
