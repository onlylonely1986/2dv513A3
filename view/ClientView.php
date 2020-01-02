<?php

namespace view;

// require_once("Messages.php");
// require_once("model/ScribbleItem.php");

class ClientView {
  private static $clientName = 'ClientView::clientName';
  private static $clientWeight = 'ClientView::clientWeight';
  private static $clientPersNr = 'ClientView::clientPersNr';
  private static $clientGoal = 'ClientView::clientGoal';
  private static $send1 = 'ClientView::send1';
  private static $clientExercise = 'ClientView::clientExercise';
  private static $clientTrainingWeight = 'ClientView::clientTrainingWeight';
  private static $clientTrainingReps = 'ClientView::clientTrainingReps';
  private static $clientTrainingResttime = 'ClientView::clientTrainingResttime';
  private static $send2 = 'ClientView::send2';
  private static $clientFoodProtein = 'ClientView::clientFoodProtein';
  private static $clientFoodAmountOfProt = 'ClientView::clientFoodAmountOfProt';
  private static $clientFoodCarbs = 'ClientView::clientFoodCarbs';
  private static $clientFoodAmountOfCarbs = 'ClientView::clientFoodAmountOfCarbs';
  private static $clientFoodFat = 'ClientView::clientFoodFat';
  private static $clientFoodAmountOfFat = 'ClientView::clientFoodAmountOfFat';
  private static $send3 = 'ClientView::send3';

  private static $removeBtn = 'ClientView::remove';
  private $message;

  public function __construct() {
    $this->message = "";
  }

  public function echoHTML() {
    return '<h2>Add new client to database:</h2>
                 ' . $this->clientFormHTML(). '
              ';
  }

    // Exercise - exercises, weights, repetitions, restTime, client id
    // Food - protein, fat, carbs, amount, client id

  private function clientFormHTML() {
    return 
        '<form href="?" method="POST">
            <p>' . $this->message . '</p>
            <h3>Client info:</h3>
            <label for="">Name:</label>
                <input type="text" id="' . self::$clientName . '" name="' . self::$clientName . '" value="" />
                <label for="">Personal nr:</label>
                <input type="text" id="' . self::$clientPersNr . '" name="' . self::$clientPersNr. '" />
                <label for="">Weight (kg):</label>
                <input type="text" id="' . self::$clientWeight . '" name="' . self::$clientWeight . '" />
                <label for="">Goal:</label>
                <input type="text" id="' . self::$clientGoal . '" name="' . self::$clientGoal. '" /></br>
            <input type="submit" id="' . self::$send1 . '" name="' . self::$send1 . '" value="Save"/>

            <h3>Exercise info:</h3>
            <label for="">Exercise:</label>
                <input type="text" id="' . self::$clientExercise . '" name="' . self::$clientExercise . '" />
                <label for="">Goal:</label>
                <input type="text" id="' . self::$clientTrainingWeight . '" name="' . self::$clientTrainingWeight . '" />
                <label for="">Goal:</label>
                <input type="text" id="' . self::$clientTrainingReps . '" name="' . self::$clientTrainingReps . '" />
                <label for="">Goal:</label>
                <input type="text" id="' . self::$clientTrainingResttime . '" name="' . self::$clientTrainingResttime . '" />
            <input type="submit" id="' . self::$send2 . '" name="' . self::$send2 . '" value="Save"/>

            <h3>Food info:</h3>
            <label for="">Protein:</label>
                <input type="text" id="' . self::$clientFoodProtein . '" name="' . self::$clientFoodProtein . '" />
                <label for="">Amount of protein (g):</label>
                <input type="text" id="' . self::$clientFoodAmountOfProt . '" name="' . self::$clientFoodAmountOfProt . '" />
                <label for="">Carbs:</label>
                <input type="text" id="' . self::$clientFoodCarbs . '" name="' . self::$clientFoodCarbs . '" />
                <label for="">Amount of carbs (g):</label>
                <input type="text" id="' . self::$clientFoodAmountOfCarbs . '" name="' . self::$clientFoodAmountOfCarbs . '" />
                <label for="">Fat:</label>
                <input type="text" id="' . self::$clientFoodFat . '" name="' . self::$clientFoodFat . '" />
                <label for="">Amount of carbs (g):</label>
                <input type="text" id="' . self::$clientFoodAmountOfFat . '" name="' . self::$clientFoodAmountOfFat . '" />
            <input type="submit" id="' . self::$send3 . '" name="' . self::$send3 . '" value="Save"/>

        </form>
        ';
  }
}
