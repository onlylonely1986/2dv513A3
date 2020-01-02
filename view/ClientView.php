<?php

namespace view;

// require_once("Messages.php");
// require_once("model/ScribbleItem.php");

class ClientView {
  private static $send = 'ClientView::send';
  private static $title = 'ClientView::title';
  private static $text = 'ClientView::text';
  private static $removeBtn = 'ClientView::remove';
  private $message;

  public function __construct() {
    $this->message = "";
  }

  public function echoHTML($sessionLoggedin) {
    return '<h2>Add new client to database:</h2>
                 ' . $this->clientFormHTML(). '
              ';
  }

  private function clientFormHTML() {
    return 
        '<form href="?" method="POST">
            <p>' . $this->message . '</p>
            <label for="">Name:</label>
            <input type="text" id="' . self::$clientName . '" name="' . self::$clientName . '" value="" />
            <label for="">Personal nr:</label>
            <input type="text" id="' . self::$clientPersNr . '" name="' . self::$clientPersNr. '" />
            <label for="">Weight (kg):</label>
            <input type="text" id="' . self::$clientWeight . '" name="' . self::$clientWeight . '" />
            <label for="">Goal:</label>
            <input type="text" id="' . self::$clientGoal. '" name="' . self::$clientGoal. '" />
            <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>
        </form>
        ';
  }
}
