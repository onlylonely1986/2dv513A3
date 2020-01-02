<?php

namespace controller;

require_once("model/Client.php");

class ClientController {
    private $view;
    private $storage;
    private $session;
    private $newClient;

    public function __construct(\view\SearchView $view, \model\ClientStorage $storage, \model\SessionModel $session) {
        $this->view = $view;
        $this->storage = $storage;
        $this->session = $session;
    }

    public function searchForClient() {

    }

    public function addNewClient() {
        $user = $this->view->returnNewClientName();
        $dateOfBirth = $this->view->returnNewClientDateOfBirth();
        $weight = $this->view->returnNewClientWeight();
        $goal = $this->view->returnNewClientGoal();

        $this->storage->saveNewClientToDB($this->setNewUser($name, $dateOfBirth, $weight, $goal));

        // $this->session->setRegisterSession();
        // if ($this->view->wantsToRegister()) {
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
