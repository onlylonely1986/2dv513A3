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
require_once("view/addClientView.php");
require_once("view/ClientView.php");
require_once("view/ExerciseView.php");
require_once("view/FoodView.php");
require_once("view/SearchView.php");
require_once("controller/ClientController.php");
require_once("controller/States.php");

class Application 
{
    private $layoutView;
    /*private $addClientView;
    private $ClientView;
    private $exerciseView; */
    private $clientController; 
    // private $view;

    public function __construct($settings) 
        {
            $this->session = new \model\SessionModel();
            $this->ClientStorage = new \model\ClientStorage($settings);
            $this->layoutView  = new \view\LayoutView();
            $this->searchView  = new \view\SearchView();
            $this->clientController = new \controller\ClientController(
                $this->layoutView,
                $this->searchView,
                $this->ClientStorage,
                $this->session
            );
        }

    public function run() 
        {
            $this->changeState();
            $this->generateOutput();
        }

    private function changeState() 
        {
            $data;
            try {
                if ($this->ClientStorage->connect()) {
                    $data = $this->ClientStorage->getClientsFromDB();
                }
            } catch (\model\ConnectionException $e) {
                echo "errrrrooor";
                // $this->layoutView->setMessage($this->userMsg::$messageToUserConn);
            }
            
            $this->searchView->setList($data);
            $this->view = $this->clientController->handleClient();
        }

    private function generateOutput()
        {
            $this->layoutView->render();
        }
}