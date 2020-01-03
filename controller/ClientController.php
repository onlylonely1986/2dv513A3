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
        $this->clientView->wantsToSaveNewClient();
        echo "japp";
        

        // $user = $this->clientView->returnNewClientName();
        // $dateOfBirth = $this->clientView->returnNewClientDateOfBirth();
        // $weight = $this->clientView->returnNewClientWeight();
        // $goal = $this->clientView->returnNewClientGoal();

        // $this->storage->saveNewClientToDB($this->setNewUser($name, $dateOfBirth, $weight, $goal));

        // $this->session->setRegisterSession();
        
        //     if($this->view->hitButton()) {
        //         if($this->view->isAllFieldsFilled()) {
        //             if($this->view->validateInputs()) {
        //                 $user = $this->view->returnNewUserName();
        //                 if($this->storage->checkForPossibleName($user)) {
        //                     $password = $this->view->returnNewPassword();
        //                     $this->setNewUser($user, $password);
        //                     $this->storage->saveNewUserToDB($this->newUser);
        //                     $this->session->setRegisterSession();
        //                     return true;
        //                 } else {
        //                     $this->view->wasNotPossibleToCreate();
        //                     return false;
        //                 }
        //             }
        //         }
        //     }
        // }
        // return false;
    }

    private function setNewClient($name, $dateOfBirth, $weight, $goal) {
        return new \model\Client($name, $dateOfBirth, $weight, $goal);
    }
}
