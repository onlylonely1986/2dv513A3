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
    private $viewRows;

    public function __conctruct ()
        {
        }
    
    public function echoHTML() 
        {
            if (isset($_GET['showview'])) 
                {
                    return
                    '<h2>Show view:</h2>
                    <p>This query creates a new table when just showing every client and their goal.</p>
                    <p>Then we run a new query that select every client that has `pushups` as their exercise.</p>
                    ' . $this->showView() . '
                    ';
                }
            else if (isset($_GET['join'])) 
                {
                    return
                    '<h2>Join:</h2>';
                }
            else if (isset($_GET['innerjoin'])) 
                {
                    return
                    '<h2>Inner Join:</h2>';
                }
            else if (isset($_GET['union'])) 
                {
                    return
                    '<h2>Union:</h2>';
                }
            else 
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
            
        }

    public function setList($data) 
        {
            $this->clients = $data;
        }
    
    public function setListOfViewRows($data) 
    {
        $this->viewRows = $data;
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

        private function showView() 
        {
            $ret = "";
            $ret .= "<table style='background-color:LightGrey; color:black'>
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Goal</b></th>
                        <th><b>Exercise</b></th>
                    </tr>";
            if ($this->viewRows != NULL)
            {
                foreach ($this->viewRows as $row) 
                {
                    $ret .= "
                        <tr>
                            <td>" . $row->name . "</td>
                            <td>" . $row->goal . "</td>
                            <td>" . $row->exercise . "</td>
                        </tr>";
                }
            }
            $ret .= "</table>";
            return $ret;
        }
}
