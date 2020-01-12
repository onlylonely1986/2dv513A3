<?php 

namespace view;

require_once("Messages.php");
require_once("IView.php");

class FoodView implements IView
{
    private static $protein = 'FoodView::clientFoodProtein';
    private static $amountProtein = 'FoodView::clientFoodAmountOfProt';
    private static $carbs = 'FoodView::clientFoodCarbs';
    private static $amountCarbs = 'FoodView::clientFoodAmountOfCarbs';
    private static $fat = 'FoodView::clientFoodFat';
    private static $amountFat = 'FoodView::clientFoodAmountOfFat';
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
      if (isset($_POST[self::$send]))
      {
          if ((empty($_POST[self::$protein]) || empty($_POST[self::$amountProtein])) || empty($_POST[self::$carbs]) || empty($_POST[self::$amountCarbs]) || empty($_POST[self::$fat]) || empty($_POST[self::$amountFat])) {
              $this->message .= Messages::$fillAll;
              return false;
          }
          return true;
    }
    else return false;
  }

  public function returnProtein() {
    if (isset($_POST[self::$protein])) {
      self::$protein = $_POST[self::$protein];
      return self::$protein;
    }
  }

  public function returnAmountProtein() {
    if (isset($_POST[self::$amountProtein])) {
      self::$amountProtein = $_POST[self::$amountProtein];
      return self::$amountProtein;
    }
  }

  public function returnCarbs() {
    if (isset($_POST[self::$carbs])) {
      self::$carbs = $_POST[self::$carbs];
      return self::$carbs;
    }
  }

  public function returnAmountCarbs() {
    if (isset($_POST[self::$amountCarbs])) {
      self::$amountCarbs = $_POST[self::$amountCarbs];
      return self::$amountCarbs;
    }
  }

  public function returnFat() {
    if (isset($_POST[self::$fat])) {
      self::$fat = $_POST[self::$fat];
      return self::$fat;
    }
  }

  public function returnAmountFat() {
    if (isset($_POST[self::$amountFat])) {
      self::$amountFat = $_POST[self::$amountFat];
      return self::$amountFat;
    }
  }

  public function message() {
    $this->message = Messages::$wentGoodFood;
  }

  public function messageFail() {
    $this->message = Messages::$wentBad;
  }

    private function foodFormHTML() {
        return 
            '<form href="?" method="POST">
                <p>' . $this->message . '</p>
                <h3>Food info:</h3>
                <label for="">Protein:</label>
                    <input type="text" id="' . self::$protein . '" name="' . self::$protein . '" />
                    <label for="">Amount of protein (g):</label>
                    <input type="text" id="' . self::$amountProtein . '" name="' . self::$amountProtein . '" />
                    <label for="">Carbs:</label>
                    <input type="text" id="' . self::$carbs . '" name="' . self::$carbs . '" />
                    <label for="">Amount of carbs (g):</label>
                    <input type="text" id="' . self::$amountCarbs . '" name="' . self::$amountCarbs . '" />
                    <label for="">Fat:</label>
                    <input type="text" id="' . self::$fat . '" name="' . self::$fat . '" />
                    <label for="">Amount of fat (g):</label>
                    <input type="text" id="' . self::$amountFat . '" name="' . self::$amountFat . '" />
                <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>
            </form>
            ';
      }
}
