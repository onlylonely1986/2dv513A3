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

    public function setListExercises($dataExercises) 
        {
            $this->exercises = $dataExercises;
        }

    public function getRequest() : bool
        {
            if (isset($_GET['id'])) 
            {
                $this->id = $_GET['id'];
                return true;
            } 
            else 
            {
                return false; 
            }
        }

    public function getID() : int 
        {
            return $this->id;
        }

    private function iterateOverClients() 
        {
            $ret = "";            
            foreach ($this->clients as $client) 
            {
                $ret .= "<p>* <a href='?client&id=" . $client->getId() . "
                '>" . $client->getId() . ": " . $client->getName() . "</a></p>";
            }
            return $ret;
        }
}
