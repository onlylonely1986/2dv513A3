<?php

namespace view;

// require_once("Messages.php");
// require_once("model/ScribbleItem.php");

class ClientView {
  private static $send = 'ScribbleView::send';
  private static $title = 'ScribbleView::title';
  private static $text = 'ScribbleView::text';
  private static $removeBtn = 'ScribbleView::remove';
  private $message;
  private $userName;
  private $collection;

  public function __construct() {
    $this->message = "";
  }

  public function echoHTML($sessionLoggedin) {
   
    return '<h2>What s up today ' . $this->userName . ' ?</h2>
                 ' . $this->clientFormHTML(). '
                 ' . $this->iterateOverScribbles() . '
              ';
  }

  
  private function checkValidInput() {
    if(preg_match('/[^\w -!?@#$%^&*()]/', $_POST[self::$title]) || preg_match('/[^\w -!?@#$%^&*()]/', $_POST[self::$text])) {
      $this->message = Messages::$invalidCharsInInput;
      self::$title = strip_tags($_POST[self::$title]);
      self::$text = strip_tags($_POST[self::$text]);
    } else {
      $this->message = Messages::$messagePublished;
      self::$title = $_POST[self::$title];
      self::$text = $_POST[self::$text];
    }
  }

  public function getTitle() {
    return self::$title;
  }
  
  public function getText() {
    return self::$text;
  }

  public function removeScribble() : bool {
    // TODO implement this 
    if (isset($_POST[self::$removeBtn])) {
      return true;
    } else return false;
  }
  
  public function setCollection($data) {
    $this->collection = $data;
  }

  public function setLoggedinState($user) {
    $this->userName = $user;
  }

  private function iterateOverScribbles() {
    $ret = "";
    foreach ($this->collection as $item) {
      $user = $item->user;
      $title = $item->title;
      $text = $item->text;
      $ret .= "<p>Post: <b>$user</b>  says: $title || $text</p>";
      if($this->userName == $item->user) {
        $ret .= '<input type="submit" name="' . self::$removeBtn . '" value="Remove"/>';
      }
    }
    return $ret;
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