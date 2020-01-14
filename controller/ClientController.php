<?php

namespace controller;

require_once("model/Client.php");
require_once("model/Exercise.php");
require_once("model/Food.php");

require_once("controller/States.php");
require_once("controller/StringConstants.php");
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
    private $dataExercises;
    private $food;
    private $foodView;
    private $dataFood;
    private $id;

    public function __construct(\view\LayoutView $layoutView, \view\SearchView $searchView, \model\ClientStorage $storage, \model\SessionModel $session)
        {
            $this->layoutView = $layoutView;
            $this->searchView = $searchView;
            $this->storage = $storage;
            $this->session = $session;
        }

    public function handleClient()
        {
            if ($this->clientPageReq()) 
                {
                    $this->clientView();
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
                    $this->addFoodToClient();
                    $this->layoutView->setView($this->foodView->echoHTML());
                    return;
                } 
            else if ($this->addClientPageReq()) 
                {
                    $this->addNewClient();
                    $this->layoutView->setView($this->addClientView->echoHTML());
                    return;
                } 
            else if ($this->showViewPageReq()) 
                {
                    $data = $this->storage->getRowsByView();
                    $this->searchView->setListOfRows($data);
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
                } 
            else if ($this->joinPageReq()) 
                {
                    $data = $this->storage->getRowsByJoin();
                    $this->searchView->setListOfRows($data);
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
                } 
            else if ($this->innerJoinPageReq()) 
                {
                    $data = $this->storage->getRowsByInnerJoin();
                    $this->searchView->setListOfRows($data);
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
                }
            else if ($this->includePTPageReq()) 
                {
                    $data = $this->storage->getRowsByIncludePT(StringConstants::$ptName1, 1);
                    $this->searchView->setListOfRows($data);
                    $data = $this->storage->getRowsByIncludePT(StringConstants::$ptName2, 3);
                    $this->searchView->setListOfRows2($data);
                    $data = $this->storage->getRowsByIncludePT(StringConstants::$ptName3, 5);
                    $this->searchView->setListOfRows3($data);
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
                } 
            else if ($this->startPageReq()) 
                {
                    $this->layoutView->setView($this->searchView->echoHTML());
                    return;
                }
            else 
                {
                    if ($this->searchView->wantsToSearch()) 
                    {
                        if ($this->searchView->searchWordGiven()) 
                        {
                            $searchWord = $this->searchView->getSearchWord();
                            // TODO
                            echo $searchWord;
                            $data = $this->storage->searchByName($searchWord);
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

    public function exercisePageReq() : bool 
        {
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
    
    private function showViewPageReq() : bool
        {
            if (isset($_GET['showview'])) {
                return true;
            }
            return false;
        }

    private function joinPageReq() : bool
        {
            if (isset($_GET['join'])) {
                return true;
            }
            return false;
        }

    private function innerJoinPageReq() : bool
        {
            if (isset($_GET['innerjoin'])) {
                return true;
            }
            return false;
        }

    private function includePTPageReq() : bool
        {
            if (isset($_GET['includept'])) {
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
    
    private function clientView()
        {
            $this->id = $this->searchView->getID();
            $this->dataExercises = $this->storage->getExercisesFromDB();
            $this->dataFood = $this->storage->getFoodFromDB();
            $this->client = $this->storage->getClientInfo($this->id);
            $this->exercises = $this->storage->getClientExercises($this->id);
            $this->food = $this->storage->getClientFood($this->id);
            $this->clientView  = new \view\ClientView();
            $this->clientView->setClient($this->client);
            $this->clientView->setListExercises($this->dataExercises);
            $this->clientView->setExercise($this->exercises);
            $this->clientView->setListFood($this->dataFood);
            $this->clientView->setFood($this->food);
            $this->layoutView->setView($this->clientView->echoHTML());
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

    private function addFoodToClient() 
        {
            $this->foodView  = new \view\FoodView();
            $this->id = (int)$_SESSION['id'];
            
            if ($this->foodView->wantsToAddFood()) 
            {
                if ($this->foodView->isAllFieldsFilled()) 
                    {
                        $protein = $this->foodView->returnProtein();
                        $amountprotein = $this->foodView->returnAmountProtein();
                        $carbs = $this->foodView->returnCarbs();
                        $amountcarbs = $this->foodView->returnAmountCarbs();
                        $fat = $this->foodView->returnFat();
                        $amountfat = $this->foodView->returnAmountFat();

                        $foodAdvice = new \model\Food($protein, $amountprotein, $carbs, $amountcarbs, $fat, $amountfat);
                        if ($this->storage->saveFoodToDB($foodAdvice, $this->id))
                            {
                                $this->foodView->message();
                            }
                    }
            }
        }
}
