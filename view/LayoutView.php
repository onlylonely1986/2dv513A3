<?php 

namespace view;

class LayoutView {

    private $sessionLoggedin;
    private $sessionRegister;
    private $message = "";
    private static $send = 'LayoutView::send';
    private static $clientName = 'LayoutView::clientName';
    private static $clientPersNr = 'LayoutView::clientPersNr';
    private static $clientWeight = 'LayoutView::clientWeight';
    private static $clientGoal = 'LayoutView::clientGoal';
    private static $removeBtn = 'LayoutView::remove';

    public function __construct() {
        $this->message = "";
    }
    public function setLoggedinState($sessionLoggedin) {
        $this->sessionLoggedin = $sessionLoggedin;
    }
    
    public function setRegisterState($sessionRegister) {
        $this->sessionRegister = $sessionRegister;
    }
    
    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function render() {

        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>PT helper</title>
                </head>
                <body>
                ' . $this->message . '
                
                ' . $this->title() . '
                <div class="container">
                    ' . $this->body() . '
                </div>
                    ' . $this->ifLoggedIn() . '
                </body>
            </html>
        ';
    }
    

    private function ifLoggedIn() {
        if ($this->sessionLoggedin){
            return '<div> ' . $sv->echoHTML($this->sessionLoggedin) . ' </div';
        }
    }


    private function title() {
        return "<h1>New client:</h1>";
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

    private function body() {
       
    //     if ($this->sessionRegister && isset($_GET['register'])){
    //       return $v->echoHTML($this->sessionLoggedin);
    //     } else if (isset($_GET['register'])) {
    //       return $rv->echoHTML();
    //     } else {
    //       return $v->echoHTML($this->sessionLoggedin);
    //     }
        }
}
