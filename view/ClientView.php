<?php

namespace view;

require_once("Messages.php");
// require_once("model/ScribbleItem.php");

class ClientView {
  private static $clientName = 'ClientView::clientName';
  private static $clientWeight = 'ClientView::clientWeight';
  private static $clientDateOfBirth = 'ClientView::clientDateOfBirth';
  private static $clientGoal = 'ClientView::clientGoal';
  private static $send = 'ClientView::send';

  private static $removeBtn = 'ClientView::remove';
  private $message;

  public function __construct() {
    $this->message = "";
  }

  public function echoHTML() 
  {
    return '<h2>Add new client to database:</h2>
                 ' . $this->clientFormHTML(). '
              ';
  }

  public function wantsToSaveNewClient() : bool 
    {
      if (isset($_POST[self::$send])) {
        echo "ok you want to save something";
        return true;
      }
      return false;
    }

  public function isAllFieldsFilled() : bool {
      if (isset($_POST[self::$send])) {
          if ((empty($_POST[self::$clientDateOfBirth]) || empty($_POST[self::$clientWeight])) || empty($_POST[self::$clientName]) || empty($_POST[self::$clientGoal])) {
              $this->message .= Messages::$fillAll;
              return false;
          }
          return true;
  }
  else return false;
  }

  public function returnNewClientName() {

  }

  public function returnNewClientDateOfBirth() {
    
  }

  public function returnNewClientWeight() {
    
  }

  public function returnNewClientGoal() {
    
  }

    // Exercise - exercises, weights, repetitions, restTime, client id
    // Food - protein, fat, carbs, amount, client id

  private function clientFormHTML() {
    return 
        '<form href="?" method="POST">
            <p style="color: red">' . $this->message . '</p>
            <h3>Client info:</h3>
            <label for="">Name:</label>
                <input type="text" id="' . self::$clientName . '" name="' . self::$clientName . '" value="" />
                <label for="">Date of birth:</label>
                <input type="text" id="' . self::$clientDateOfBirth . '" name="' . self::$clientDateOfBirth. '" />
                <label for="">Weight (kg):</label>
                <input type="text" id="' . self::$clientWeight . '" name="' . self::$clientWeight . '" />
                <label for="">Goal:</label>
                <input type="text" id="' . self::$clientGoal . '" name="' . self::$clientGoal. '" /></br>
            <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>

        </form>
        ';
  }
}
