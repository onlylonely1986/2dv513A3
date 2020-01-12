<?php 

namespace view;

class LayoutView
{

    private $message = "";
    private $view;

    public function __construct()
    { 

    }
    
    public function setMessage($message) 
    {
        $this->message = $message;
    }

    public function setView($view) 
    {
        $this->view = $view;
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
            if(isset($_GET['client']) || isset($_GET['clientInfo']) || isset($_GET['exercises']) || isset($_GET['food'])) 
                {
                    return 
                    "<div class='topnav'>
                        <a class='active' href='?'>Start</a>
                        <a href='?clientInfo'>ClientInfo</a>
                        <a href='?exercises'>New Exercises</a>
                        <a href='?food'>New Food</a>
                    </div>";
                } else 
                {
                    return 
                    "<div class='topnav'>
                        <a class='active' href='?'>Start</a>
                        <a href='?clients'>New Client</a>
                    </div>
                    </br>
                    <div class='topnav2'>
                        <a href='?showview'>Show View</a>
                        <a href='?join'>Join</a>
                        <a href='?innerjoin'>Inner Join</a>
                        <a href='?union'>Union</a>
                    </div>";
                }
           
        }

    private function body()
        {
            return $this->view;
        }
}
