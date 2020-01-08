<?php
/**
 * Application.php
 * 
 * The entry point of the application
 * 
 * @author Lone Nilsson, Sanna Gustafsson
 * @version 1.0
 * @link https://github.com/onlylonely1986/2dv513A3
 */

require_once("model/ClientStorage.php");
require_once("model/SessionModel.php");
// require_once("view/ExceptionHTMLMessages.php");
require_once("view/LayoutView.php");
require_once("view/AddNewClientView.php");
require_once("view/ClientView.php");
require_once("view/ExerciseView.php");
require_once("view/FoodView.php");
require_once("view/SearchView.php");
require_once("controller/ClientController.php");
require_once("controller/States.php");

class Application 
{
    private $layoutView;
    private $addNewClientView;
    private $clientView;
    private $exerciseView;
    private $clientController;

    public function __construct($settings) 
        {
            $this->session = new \model\SessionModel();
            $this->clientStorage = new \model\ClientStorage($settings);
            $this->addNewClientView  = new \view\AddNewClientView();
            $this->clientView  = new \view\ClientView();
            $this->exerciseView  = new \view\ExerciseView();
            $this->foodView  = new \view\FoodView();
            $this->searchView  = new \view\SearchView();
            $this->layoutView  = new \view\LayoutView($this->addNewClientView, $this->clientView, $this->exerciseView, $this->foodView, $this->searchView);
            $this->clientController = new \controller\ClientController($this->searchView, 
                $this->addNewClientView,
                $this->clientView,
                $this->clientStorage, 
                $this->session);
        }

    public function run() 
        {
            $this->changeState();
            $this->generateOutput();
        }

    private function changeState() 
        {
            $whatState = $this->clientController->getState();
            switch ($whatState) {
                case \controller\States::$pickClient:
                    // code to be executed if n=label1;
                    break;
                case \controller\States::$newExercise:
                    // code to be executed if n=label2;
                    break;
                case \controller\States::$newFood:
                    // code to be executed if n=label3;
                    break;
                case \controller\States::$newClient:
                    // code to be executed if n=label3;
                    break;
                case \controller\States::$newSearch:
                    // code to be executed if n=label3;
                    break;
                default:
                    return;
                    // code to be executed if n is different from all labels;
            }
        }

    private function generateOutput()
        {
            $data;
            try {
                if ($this->clientStorage->connect()) {
                    $data = $this->clientStorage->getClientsFromDB();
                }
            } catch (\model\ConnectionException $e) {
                echo "errrrrooor";
                // $this->layoutView->setMessage($this->userMsg::$messageToUserConn);
            }
            
            $this->searchView->setList($data); 
            $this->layoutView->render();
        }
}