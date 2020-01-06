<?php 

namespace view;

class LayoutView {

    private $sessionLoggedin;
    private $sessionRegister;
    private $message = "";
    private $addNewClientView;
    private $exerciseView;
    private $foodView;
    private $searchView;
    private $sessionIndex = 'exercises';
    private $sessionIndex2 = 'clients';
    private $sessionIndex3 = 'food';
    private static $send = 'LayoutView::send';
    private static $clientName = 'LayoutView::clientName';
    private static $clientPersNr = 'LayoutView::clientPersNr';
    private static $clientWeight = 'LayoutView::clientWeight';
    private static $clientGoal = 'LayoutView::clientGoal';
    private static $removeBtn = 'LayoutView::remove';

    public function __construct(AddNewClientView $addNewClientView, ClientView $clientView, ExerciseView $exerciseView, FoodView $foodView, SearchView $searchView) 
    {
        $this->message = "";
        $this->addNewClientView = $addNewClientView;
        $this->clientView = $clientView;
        $this->exerciseView = $exerciseView;
        $this->foodView = $foodView;
        $this->searchView = $searchView;
    }
    
    public function setLoggedinState($sessionLoggedin) 
    {
        $this->sessionLoggedin = $sessionLoggedin;
    }
    
    public function setRegisterState($sessionRegister) 
    {
        $this->sessionRegister = $sessionRegister;
    }
    
    public function setMessage($message) 
    {
        $this->message = $message;
    }
    
    public function render() 
    {
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>PT helper</title>
                </head>
                <body>
                ' . $this->message . '
                
                ' . $this->title() . '
                ' . $this->nav() . '
                

                <div class="container">
                    ' . $this->body() . '
                </div>
                    ' . $this->ifLoggedIn() . '
                </body>
            </html>
        ';
    }
    

    private function ifLoggedIn() 
    {
        if ($this->sessionLoggedin){
            return '<div> ' . $sv->echoHTML($this->sessionLoggedin) . ' </div';
        }
    }


    private function title() 
        {
            return "<h1>PT 2 Client</h1>";
        }

    private function nav()
        {
            if(isset($_GET['clientInfo']) || isset($_GET['exercises']) || isset($_GET['food'])) 
                {
                    return 
                    '<div class="topnav">
                        <a class="active" href="?">Start</a>
                        <a href="?clientInfo">ClientInfo</a>
                        <a href="?exercises">New Exercises</a>
                        <a href="?food">New Food</a>
                    </div>';
                } else 
                {
                    return 
                    '<div class="topnav">
                        <a class="active" href="?">Start</a>
                        <a href="?clients">New Client</a>
                    </div>';
                }
           
        }

    private function body() 
        {
            if (isset($_GET['clientInfo'])) {
                $_SESSION['pickedClientId'] = 1;
                $_SESSION['pickedClientName'] = 'Lone';
                return $this->clientView->echoHTML();
            }
              else if (isset($_GET['exercises'])) {
                return $this->exerciseView->echoHTML();
            } else if (isset($_GET['clients'])) {
                return $this->addNewClientView->echoHTML();
            } else if (isset($_GET['food'])) {
                return $this->foodView->echoHTML();
            } else {
                return $this->searchView->echoHTML();
            }
            
            //     if ($this->sessionRegister && isset($_GET['register'])){
            //       return $v->echoHTML($this->sessionLoggedin);
            //     } else if (isset($_GET['register'])) {
            //       return $rv->echoHTML();
            //     } else {
            //       return $v->echoHTML($this->sessionLoggedin);
            //     }
        }

    private function exerciseLinkPressed()
        {
            if (isset($_GET['exercises'])) {
                echo "länken funkar";
            }
          // return isset($_GET[$this->sessionIndex]);
        }
}
