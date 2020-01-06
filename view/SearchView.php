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

    
    private function iterateOverClients() 
        {
            $ret = "";            
            foreach ($this->clients as $client) 
            {
                $clientName = $client->name;
                $ret .= "<p>* <a href='?clientInfo'>" . $client->getId() . ": $clientName</a></p>";
            }
            return $ret;
        }
}
