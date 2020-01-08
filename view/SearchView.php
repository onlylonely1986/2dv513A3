<?php 
namespace view;

class SearchView 
{
    private $message = '';
    private static $clientSearch = 'SearchView::clientSearch';
    private static $send = 'SearchView::send';
    private $clients;

    public function __conctruct ()
        {
            unset($_SESSION['pickedClientId']);
            unset($_SESSION['pickedClientName']);
        }
    
    public function echoHTML() 
        {
            return 
                '<h2>Search:</h2>
                    <form href="?" method="POST">
                        <input type="text" id="' . self::$clientSearch . '" name="' . self::$clientSearch . '" />
                        <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Search"/>
                    </form>
                    ' . $this->message . '
                    ' . $this->iterateOverClients() . '
                ';
        }

    public function setList($data) 
        {
            $this->clients = $data;
        }
    
    public function getRequest() : bool {
        $id = substr($_SERVER['REQUEST_URI'], -1);
        if (isset($_GET["clientInfo?id". $id .""])) {
            return true;
        } else {
            return false;
        }
    }
    
    private function iterateOverClients() 
        {
            $ret = "";            
            foreach ($this->clients as $client) 
            {
                $clientName = $client->name;
                // ?id=" . $client->getId() . "
                $ret .= "<p>* <a href='?clientInfo?id" . $client->getId() . "
                '>" . $client->getId() . ": $clientName</a></p>";
            }
            return $ret;
        }
}
