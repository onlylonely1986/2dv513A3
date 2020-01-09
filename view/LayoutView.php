<?php 

namespace view;

class LayoutView {

    private $message = "";
    private $view;

    public function __construct(IView $view) 
    { 
        $this->view = $view; 
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
                </body>
            </html>
        ';
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
            $this->view->echoHTML();
            /*if (isset($_GET['id'])) { //Det är lite rörigt. :'D typ
                return $this->clientView->echoHTML();
            }
            return $this->searchView->echoHTML();
            /*
            if (isset($_GET['exercises'])) {
                return $this->exerciseView->echoHTML();
            } else if (isset($_GET['clients'])) {
                return $this->addClientView->echoHTML();
            } else if (isset($_GET['food'])) {
                return $this->foodView->echoHTML();
            } else {
            
            } */
        }
}
