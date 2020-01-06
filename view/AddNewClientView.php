<?php

namespace view;

require_once("Messages.php");

class AddNewClientView {
  private static $clientName = 'AddNewClientView::clientName';
  private static $clientWeight = 'AddNewClientView::clientWeight';
  private static $clientDateOfBirth = 'AddNewClientView::clientDateOfBirth';
  private static $clientGoal = 'AddNewClientView::clientGoal';
  private static $send = 'AddNewClientView::send';

  private static $removeBtn = 'AddNewClientView::remove';
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
    if (isset($_POST[self::$clientName])) {
      self::$clientName = $_POST[self::$clientName];
      return self::$clientName;
    }
  }

  public function returnNewClientDateOfBirth() {
    if (isset($_POST[self::$clientDateOfBirth])) {
      self::$clientDateOfBirth = $_POST[self::$clientDateOfBirth];
      return self::$clientDateOfBirth;
    }
  }

  public function returnNewClientWeight() {
    if (isset($_POST[self::$clientWeight])) {
      self::$clientWeight = $_POST[self::$clientWeight];
      return self::$clientWeight;
    }
  }

  public function returnNewClientGoal() {
    if (isset($_POST[self::$clientGoal])) {
      self::$clientGoal = $_POST[self::$clientGoal];
      return self::$clientGoal;
    }
  }

  public function message() {
    $this->message = Messages::$wentGood;
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
                <input type="text" id="' . self::$clientDateOfBirth . '" name="' . self::$clientDateOfBirth . '" value="" />
                <label for="">Weight (kg):</label>
                <input type="text" id="' . self::$clientWeight . '" name="' . self::$clientWeight . '" value=""/>
                <label for="">Goal:</label>
                <input type="text" id="' . self::$clientGoal . '" name="' . self::$clientGoal . '" value="" /></br>
            <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>

        </form>
        ';
  }
}
