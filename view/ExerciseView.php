<?php 

namespace view;

require_once("IView.php");

class ExerciseView implements IView 
{
    private $message = '';
    private static $clientExercise = 'ExerciseView::clientExercise';
    private static $clientTrainingWeight = 'ExerciseView::clientTrainingWeight';
    private static $clientTrainingReps = 'ExerciseView::clientTrainingReps';
    private static $clientTrainingResttime = 'ExerciseView::clientTrainingResttime';
    private static $send = 'ExerciseView::send';


    public function echoHTML() {
        return 
            '<h2>Add new exercises to database:</h2>
                ' . $this->exerciseFormHTML(). '
            ';
    }

      private function exerciseFormHTML() {
        return  
            '<form href="?" method="POST">
                <p>' . $this->message . '</p>
                <h3>Exercise info:</h3>
                <label for="">Exercise:</label>
                    <input type="text" id="' . self::$clientExercise . '" name="' . self::$clientExercise . '" />
                    <label for="">Weight:</label>
                    <input type="text" id="' . self::$clientTrainingWeight . '" name="' . self::$clientTrainingWeight . '" />
                    <label for="">Reps:</label>
                    <input type="text" id="' . self::$clientTrainingReps . '" name="' . self::$clientTrainingReps . '" />
                    <label for="">RestTime:</label>
                    <input type="text" id="' . self::$clientTrainingResttime . '" name="' . self::$clientTrainingResttime . '" />
                <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>
            ';
      }
}
