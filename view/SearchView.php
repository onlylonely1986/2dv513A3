<?php 
namespace view;

require_once("IView.php");

class SearchView implements IView
{
    private $message = '';
    private $id;
    private static $clientSearch = 'SearchView::clientSearch';
    private static $send = 'SearchView::send';
    private $clients;
    private $dataExercises;

    public function __conctruct ()
        {
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


    public function getRequest() : bool
        {
            if (isset($_GET['id'])) 
            {
                $this->id = $_GET['id'];
                $_SESSION['id'] = $this->id;
                return true;
            } 
            else 
            {
                return false; 
            }
        }

    public function wantsToSearch() : bool 
        {
            if (isset($_POST[self::$send])) {
            return true;
            }
            return false;
        }

    public function getSearchWord() : string
        {
            if (isset($_POST[self::$clientSearch])) {
                return $_POST[self::$clientSearch];
              }
        }
    
    public function searchWordGiven() : bool 
        {
            if (isset($_POST[self::$send]))
            {
                if (empty($_POST[self::$clientSearch]))
                {
                    return false;
                }
                return true;
            }
        }

    public function getID() : int 
        {
            return (int)$this->id;
        }

    private function iterateOverClients() 
        {
            $ret = "";
            // var_dump($this->clients);
            if ($this->clients != NULL)
            {
                foreach ($this->clients as $client) 
                {
                    $ret .= "<p>* <a href='?client&id=" . $client->getID() . "
                    '>" . $client->getID() . ": " . $client->getName() . "</a></p>";
                }
            }
            
            return $ret;
        }
}
