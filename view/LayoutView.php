<?php 

namespace view;

class LayoutView {

    private $sessionLoggedin;
    private $sessionRegister;
    private $message = "";
    private $clientView;
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

    public function __construct(ClientView $clientView, ExerciseView $exerciseView, FoodView $foodView, SearchView $searchView) 
    {
        $this->message = "";
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

                <div class="topnav">
                    <a class="active" href="?">Start</a>
                    <a href="?clients">Clients</a>
                    <a href="?exercises">Exercises</a>
                    <a href="?food">Food</a>
                </div>

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
            // if ($this->sessionRegister && isset($_GET['register'])) {
            //   if($this->sessionLoggedin) {
            //     return '<h2>Logged in</h2>';
            //   } else {
            //     return '<a href="?register">Register a new user</a>
            //           <h2>Not logged in</h2>';
            //   }
            // } else if (isset($_GET['register'])) {
            //   return '<a href="?">Back to login</a>
            //             <h2>Register new member</h2>';
            // } else if($this->sessionLoggedin) {
            //   return '<h2>Logged in</h2>';
            // }
            // else {
            //   return '<a href="?register">Register a new user</a>
            //           <h2>Not logged in</h2>';
            // }
        }

    private function body() 
        {
            if (isset($_GET['exercises'])) {
                return $this->exerciseView->echoHTML();
            } else if (isset($_GET['clients'])) {
                return $this->clientView->echoHTML();
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
