<?php 

namespace view;

class SearchView 
{
    // private $message = '';
    // private static $clientSearch = 'ExerciseView::clientExercise';
    // private static $clientTrainingWeight = 'ExerciseView::clientTrainingWeight';
    // private static $clientTrainingReps = 'ExerciseView::clientTrainingReps';
    // private static $clientTrainingResttime = 'ExerciseView::clientTrainingResttime';
    // private static $send = 'ExerciseView::send';
    private $clients;
    
    public function echoHTML() 
        {
            return 
                '<h2>Search:</h2>
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
            // var_dump($this->clients);
            
            foreach ($this->clients as $client) 
            {
                $clientName = $client->name;
                var_dump($client);
                $ret .= "<p>Client: <a href='#'>$clientName</a></p>";
            }
            return $ret;
        }
}



/**  
 *<form href="?" method="POST">
  *  <p>' . $this->message . '</p>
  *  <h3>Client info:</h3>
   * <label for="">Name:</label>
    *    <input type="text" id="' . self::$clientName . '" name="' . self::$clientName . '" value="" />
    *<input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Search"/>

    * </form>
*/ 