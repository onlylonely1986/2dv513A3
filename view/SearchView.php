<?php 

namespace view;

class SearchView {
    // private $message = '';
    // private static $clientSearch = 'ExerciseView::clientExercise';
    // private static $clientTrainingWeight = 'ExerciseView::clientTrainingWeight';
    // private static $clientTrainingReps = 'ExerciseView::clientTrainingReps';
    // private static $clientTrainingResttime = 'ExerciseView::clientTrainingResttime';
    // private static $send = 'ExerciseView::send';
    
    public function echoHTML() {
        return 
            '<h2>Search:</h2>
               
                ';
           
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