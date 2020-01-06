<?php

namespace controller;

require_once("model/Client.php");

class ClientController {
    private $searchView;
    private $AddNewClientView;
    private $storage;
    private $session;
    private $newClient;

    public function __construct(\view\SearchView $searchView, \view\AddNewClientView $AddNewClientView, \model\ClientStorage $storage, \model\SessionModel $session) {
        $this->searchView = $searchView;
        $this->AddNewClientView = $AddNewClientView;
        $this->storage = $storage;
        $this->session = $session;
    }

    public function searchForClient() {

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
        return new \model\Client($name, $dateOfBirth, $weight, $goal);
    }
}
