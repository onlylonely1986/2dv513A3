<?php 

namespace view;

require_once("Messages.php");
require_once("IView.php");

class ExerciseView implements IView 
{
    private $message = '';
    private static $clientExercise = 'ExerciseView::clientExercise';
    private static $clientTrainingWeight = 'ExerciseView::clientTrainingWeight';
    private static $clientTrainingReps = 'ExerciseView::clientTrainingReps';
    private static $clientTrainingSets = 'ExerciseView::clientTrainingSets';
    private static $clientTrainingResttime = 'ExerciseView::clientTrainingResttime';
    private static $send = 'ExerciseView::send';

    public function __construct() {
        $this->message = "";
    }

    public function echoHTML() {
        return 
            '<h2>Add new exercises to database:</h2>
                ' . $this->exerciseFormHTML(). '
            ';
    }

    public function wantsToAddExercises() : bool 
    {
      if (isset($_POST[self::$send])) {
        return true;
      }
      return false;
    }

  public function isAllFieldsFilled() : bool {
      if (isset($_POST[self::$send])) {
          if ((empty($_POST[self::$clientExercise]) || empty($_POST[self::$clientTrainingWeight])) || empty($_POST[self::$clientTrainingReps]) || empty($_POST[self::$clientTrainingSets]) || empty($_POST[self::$clientTrainingResttime])) {
              $this->message .= Messages::$fillAll;
              return false;
          }
          return true;
  }
  else return false;
  }

  public function returnExercise() {
    if (isset($_POST[self::$clientExercise])) {
      self::$clientExercise = $_POST[self::$clientExercise];
      return self::$clientExercise;
    }
  }

  public function returnWeight() {
    if (isset($_POST[self::$clientTrainingWeight])) {
      self::$clientTrainingWeight = $_POST[self::$clientTrainingWeight];
      return self::$clientTrainingWeight;
    }
  }

  public function returnReps() {
    if (isset($_POST[self::$clientTrainingReps])) {
      self::$clientTrainingReps = $_POST[self::$clientTrainingReps];
      return self::$clientTrainingReps;
    }
  }

  public function returnSets() {
    if (isset($_POST[self::$clientTrainingSets])) {
      self::$clientTrainingSets = $_POST[self::$clientTrainingSets];
      return self::$clientTrainingSets;
    }
  }

  public function returnRest() {
    if (isset($_POST[self::$clientTrainingResttime])) {
      self::$clientTrainingResttime = $_POST[self::$clientTrainingResttime];
      return self::$clientTrainingResttime;
    }
  }

  public function message() {
    $this->message = Messages::$wentGoodEx;
  }

  public function messageFail() {
    $this->message = Messages::$wentBad;
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
                    <label for="">Sets:</label>
                    <input type="text" id="' . self::$clientTrainingSets . '" name="' . self::$clientTrainingSets . '" />
                    <label for="">RestTime:</label>
                    <input type="text" id="' . self::$clientTrainingResttime . '" name="' . self::$clientTrainingResttime . '" />
                <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>
            ';
      }
}
