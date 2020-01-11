<?php

namespace controller;

require_once("model/Client.php");
require_once("model/Exercise.php");

require_once("controller/States.php");
require_once("view/ClientView.php");
require_once("view/AddClientView.php");
require_once("view/ExerciseView.php");
require_once("view/FoodView.php");

class ClientController
{
    private $layoutView;
    private $searchView;
    private $addClientView;
    private $clientView;
    private $storage;
    private $session;
    private $newClient;
    private $client;
    private $exercises;
    private $exerciseView;
    private $food;
    private $id;
    private $dataExercises;

    public function __construct(\view\LayoutView $layoutView, \view\SearchView $searchView, \model\ClientStorage $storage, \model\SessionModel $session)
        {
            $this->layoutView = $layoutView;
            $this->searchView = $searchView;
            $this->storage = $storage;
            $this->session = $session;
            // $this->clientView = $clientView; 
        }

    public function handleClient()
        {
            if ($this->clientPageReq()) 
                {
                    // vald client spara i session?
                    // hämta all info från storage
                    // skicka med till clientview
                    $this->id = $this->searchView->getID();
                    $this->dataExercises = $this->storage->getExercisesFromDB();
                    $this->client = $this->storage->getClientInfo($this->id);
                    $this->exercises = $this->storage->getClientExercises($this->id);
                    $this->food = $this->storage->getClientFood($this->id);
                    $this->clientView  = new \view\ClientView();
                    $this->clientView->setClient($this->client);
                    $this->clientView->setListExercises($this->dataExercises);
                    $this->clientView->setExercise($this->exercises);
                    $this->clientView->setFood($this->food);
                    $this->layoutView->setView($this->clientView->echoHTML());
                    return;
                } 
            else if($this->exercisePageReq())
                {
                    $this->addExerciseToClient();
                    $this->layoutView->setView($this->exerciseView->echoHTML());
                    return;
                }
            else if($this->foodPageReq())
                {
                    $this->foodView  = new \view\FoodView();
                    $this->layoutView->setView($this->foodView->echoHTML());
                    return;
                } 
            else if ($this->addClientPageReq()) 
                {
                    $this->addNewClient();
                    $this->layoutView->setView($this->addClientView->echoHTML());
                    return;
                } 
            else if ($this->startPageReq()) 
                {
                    // TODO lägg metod för sökning här också, samma som i else under, 
                    // kan ske vid olika tillfällen
                    
                    
                    // hämta info från searchview
                    // hämta info från storage
                    // skicka message till searchview
                    // hämta från storage
                    // rendera lista med sökförslag
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
                }
            else 
                {
                    if ($this->searchView->wantsToSearch()) 
                        {
                            if ($this->searchView->searchWordGiven()) {
                                // echo "när körs denna?";
                                $searchWord = $this->searchView->getSearchWord();
                                $data = $this->storage->searchByName($searchWord);
                                // var_dump($data);
                                $this->searchView->setList($data);
                            }
                        }
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
    }
}

    public function clientPageReq() : bool 
    {
        if ($this->searchView->getRequest()) 
        {
            return true;
        }
        return false;
    }

    public function exercisePageReq() : bool {
        if (isset($_GET['exercises']))
        {
            return true;
        }
        return false;
    }
            

    public function foodPageReq() : bool
        {
            if (isset($_GET['food']))
                {

                    return true;
                }
            return false;
        }


    private function addClientPageReq() : bool
        {
            if (isset($_GET['clients'])) {

                return true;
            }
            return false;
        }

    private function startPageReq() : bool 
        {
            if (isset($_GET[''])) {

                return true;
            }
            return false;
        }


    private function addNewClient() 
        {
            $this->addClientView = new \view\addClientView();
            if ($this->addClientView->wantsToSaveNewClient()) 
                {
                    if ($this->addClientView->isAllFieldsFilled()) 
                        {
                            $name = $this->addClientView->returnNewClientName();
                            $dateOfBirth = $this->addClientView->returnNewClientDateOfBirth();
                            $weight = $this->addClientView->returnNewClientWeight();
                            $goal = $this->addClientView->returnNewClientGoal();
                            if ($this->storage->saveNewClientToDB(new \model\Client($name, $dateOfBirth, $weight, $goal)))
                                {
                                    $this->addClientView->message();
                                }
                        }
                }
        }

    private function addExerciseToClient() 
    {
        $this->exerciseView = new \view\ExerciseView();
        $this->id = (int)$_SESSION['id'];
        
        if ($this->exerciseView->wantsToAddExercises()) 
        {
            if ($this->exerciseView->isAllFieldsFilled()) 
                {
                    $exercise = $this->exerciseView->returnExercise();
                    $weight = $this->exerciseView->returnWeight();
                    $repetitions = $this->exerciseView->returnReps();
                    $sets = $this->exerciseView->returnSets();
                    $rest = $this->exerciseView->returnRest();

                    if ($this->storage->saveNewExerciseToDB(new \model\Exercise($exercise, $weight, $repetitions, $sets, $rest), $this->id))
                        {
                            $this->exerciseView->message();
                        }
                }
        }
    }
}
