<?php

namespace controller;

require_once("model/Client.php");
require_once("controller/States.php");

class ClientController {
    private $layoutView;
    private $searchView;
    private $addClientView;
    private $clientView;
    private $storage;
    private $session;
    private $newClient;
    private $client;
    private $exercises;
    private $food;

    public function __construct(\view\LayoutView $layoutView, \view\SearchView $searchView, \model\ClientStorage $storage, \model\SessionModel $session) {
        $this->layoutView = $layoutView;
        $this->searchView = $searchView;
        /*$this->addClientView = $addClientView;
        $this->clientView = $clientView; */
        $this->storage = $storage;
        $this->session = $session;
    }

    public function handleClient() {
        if ($this->pickedClient()) {
            // vald client spara i session?
            // hämta all info från storage
            // skicka med till clientview
            $id = substr($_SERVER['REQUEST_URI'], -1);
            $this->client = $this->storage->getClientInfo($id);
            $this->exercises = $this->storage->getClientExercises($id);
            $this->food = $this->storage->getClientFood($id);
            $this->clientView  = new \view\ClientView();
            $this->clientView->setClient($this->client);
            $this->clientView->setExercise($this->exercises);
            $this->clientView->setFood($this->food);
            $this->layoutView->setView($this->clientView->echoHTML());
            return;
        } else if($this->registerNewExercise()) {
            // hämta info från exerciseview
            // kontrollera info
            // spara i storage
            // skicka med message till clientInfoView
            // hämta uppdaterad info från storage
            // uppdatera clientInfoview
            $this->exerciseView  = new \view\ExerciseView();
            $this->layoutView->setView($this->exerciseView->echoHTML());
            return;
        } else if($this->registerNewFood()) {
            // hämta info från foodview
            // kontrollera info
            // spara i storage
            // skicka med message till clientInfoView   
            // hämta uppdaterad info från storage
            // uppdatera clientInfoview
            $this->foodView  = new \view\FoodView();
            $this->layoutView->setView($this->FoodView->echoHTML());
            return;
        } else if ($this->registerNewClient()) {
            // hämta info från clientview
            // kontrollera info
            // spara i storage
            // skicka med message till clientInfoView
            // hämta uppdaterad info från storage
            // uppdatera clientInfoview
            $this->addClientView  = new \view\addClientView();
            $this->layoutView->setView($this->addClientView->echoHTML());
            return;
        } else if ($this->newSearch()) {
            // hämta info från searchview
            // hämta info från storage
            // skicka message till searchview
            // hämta från storage
            // rendera lista med sökförslag
            $this->layoutView->setView($this->searchView->echoHTML());
            return;
        } else {
            $this->layoutView->setView($this->searchView->echoHTML());
            return;
        }
    }

    public function pickedClient() : bool 
    {
        if ($this->searchView->getRequest()) 
        {
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
       
        if (isset($_GET['clients'])) {
            return true;
        }
        return false;
    }

    public function newSearch() : bool {
        if (isset($_GET[''])) {
            return true;
        }
        return false;
    }

    public function addNewClient() {
        if($this->addClientView->wantsToSaveNewClient()) {
            if ($this->addClientView->isAllFieldsFilled()) {
                $user = $this->addClientView->returnNewClientName();
                $dateOfBirth = $this->addClientView->returnNewClientDateOfBirth();
                $weight = $this->addClientView->returnNewClientWeight();
                $goal = $this->addClientView->returnNewClientGoal();
                $this->storage->saveNewClientToDB($this->setNewClient($user, $dateOfBirth, $weight, $goal));
                $this->addClientView->message();                    
            }
        }
    }

    private function setNewClient($name, $dateOfBirth, $weight, $goal) {
       $this->client = new \model\Client($name, $dateOfBirth, $weight, $goal);
    }
}
