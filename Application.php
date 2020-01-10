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
    private $userMsg;
    private $clientController;
    

    public function __construct($settings) 
        {
            $this->session = new \model\SessionModel();
            $this->clientStorage = new \model\ClientStorage($settings);
            $this->layoutView  = new \view\LayoutView();
            $this->searchView  = new \view\SearchView();
            $this->clientController = new \controller\ClientController(
                $this->layoutView,
                $this->searchView,
                $this->clientStorage,
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
                if ($this->clientStorage->connect()) {
                    $data = $this->clientStorage->getClientsFromDB();
                }
            } catch (\model\ConnectionException $e) {
                // echo "errrrrooor";
                $this->userMsg = new \view\Messages();
                $this->layoutView->setMessage($this->userMsg::$messageToUserConn);
            }
            
            $this->searchView->setList($data);
            $this->view = $this->clientController->handleClient();
        }

    private function generateOutput()
        {
            $this->layoutView->render();
        }
}