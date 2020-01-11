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

require_once("model/SessionModel.php");
require_once("model/ClientStorage.php");
require_once("view/LayoutView.php");
require_once("view/SearchView.php");
require_once("view/Messages.php");
require_once("controller/ClientController.php");

class Application 
{
    private $session;
    private $clientStorage;
    private $layoutView;
    private $searchView;
    // private $clientView;
    private $userMsg;
    private $clientController;
    

    public function __construct($settings) 
        {
            $this->session = new \model\SessionModel();
            $this->clientStorage = new \model\ClientStorage($settings);
            $this->layoutView  = new \view\LayoutView();
            $this->searchView  = new \view\SearchView();
            // $this->clientView  = new \view\ClientView();
            $this->clientController = new \controller\ClientController(
                $this->layoutView,
                $this->searchView,
                $this->clientStorage,
                $this->session
                // $this->clientView
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
            $dataExercises;
            try {
                if ($this->clientStorage->connect()) {
                    $data = $this->clientStorage->getClientsFromDB();
                    // $dataExercises = $this->clientStorage->getExercisesFromDB();
                }
            } catch (\model\ConnectionException $e) {
                // echo "errrrrooor";
                $this->userMsg = new \view\Messages();
                $this->layoutView->setMessage($this->userMsg::$messageToUserConn);
            }
            
            $this->searchView->setList($data);
            // $this->clientView->setListExercises($dataExercises);
            $this->view = $this->clientController->handleClient();
        }

    private function generateOutput()
        {
            $this->layoutView->render();
        }
}