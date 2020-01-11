<?php 

namespace view;

require_once("Messages.php");
require_once("IView.php");

class FoodView implements IView
{
    private static $clientFoodProtein = 'FoodView::clientFoodProtein';
    private static $clientFoodAmountOfProt = 'FoodView::clientFoodAmountOfProt';
    private static $clientFoodCarbs = 'FoodView::clientFoodCarbs';
    private static $clientFoodAmountOfCarbs = 'FoodView::clientFoodAmountOfCarbs';
    private static $clientFoodFat = 'FoodView::clientFoodFat';
    private static $clientFoodAmountOfFat = 'FoodView::clientFoodAmountOfFat';
    private static $send = 'FoodView::send';
    private $message = '';

    public function __construct() {
        $this->message = "";
    }

    public function echoHTML() {
        return 
            '<h2>Add new food guidlines to database:</h2>
                ' . $this->foodFormHTML() . '
            ';
    }

    public function wantsToAddFood() : bool 
    {
      if (isset($_POST[self::$send])) {
        return true;
      }
      return false;
    }

  public function isAllFieldsFilled() : bool {
      if (isset($_POST[self::$send])) {
          if ((empty($_POST[self::$clientFoodProtein]) || empty($_POST[self::$clientFoodAmountOfProt])) || empty($_POST[self::$clientFoodCarbs]) || empty($_POST[self::$clientFoodAmountOfCarbs]) || empty($_POST[self::$clientFoodFat]) || empty($_POST[self::$clientFoodAmountOfFat])) {
              $this->message .= Messages::$fillAll;
              return false;
          }
          return true;
  }
  else return false;
  }

  public function returnProtein() {
    if (isset($_POST[self::$clientFoodProtein])) {
      self::$clientFoodProtein = $_POST[self::$clientFoodProtein];
      return self::$clientFoodProtein;
    }
  }

  public function returnAmountProtein() {
    if (isset($_POST[self::$clientFoodAmountOfProt])) {
      self::$clientFoodAmountOfProt = $_POST[self::$clientFoodAmountOfProt];
      return self::$clientFoodAmountOfProt;
    }
  }

  public function returnCarbs() {
    if (isset($_POST[self::$clientFoodCarbs])) {
      self::$clientFoodCarbs = $_POST[self::$clientFoodCarbs];
      return self::$clientFoodCarbs;
    }
  }

  public function returnAmountCarbs() {
    if (isset($_POST[self::$clientFoodAmountOfCarbs])) {
      self::$clientFoodAmountOfCarbs = $_POST[self::$clientFoodAmountOfCarbs];
      return self::$clientFoodAmountOfCarbs;
    }
  }

  public function returnFat() {
    if (isset($_POST[self::$clientFoodFat])) {
      self::$clientFoodFat = $_POST[self::$clientFoodFat];
      return self::$clientFoodFat;
    }
  }

  public function returnAmountFat() {
    if (isset($_POST[self::$clientFoodAmountOfFat])) {
      self::$clientFoodAmountOfFat = $_POST[self::$clientFoodAmountOfFat];
      return self::$clientFoodAmountOfFat;
    }
  }

  public function message() {
    $this->message = Messages::$wentGoodEx;
  }

  public function messageFail() {
    $this->message = Messages::$wentBad;
  }

    private function foodFormHTML() {
        return 
            '<form href="?" method="POST">

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
                    <label for="">Amount of fat (g):</label>
                    <input type="text" id="' . self::$clientFoodAmountOfFat . '" name="' . self::$clientFoodAmountOfFat . '" />
                <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>
    
            </form>
            ';
      }
}
