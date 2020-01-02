<?php 

namespace view;

class FoodView {
    private static $clientFoodProtein = 'FoodView::clientFoodProtein';
    private static $clientFoodAmountOfProt = 'FoodView::clientFoodAmountOfProt';
    private static $clientFoodCarbs = 'FoodView::clientFoodCarbs';
    private static $clientFoodAmountOfCarbs = 'FoodView::clientFoodAmountOfCarbs';
    private static $clientFoodFat = 'FoodView::clientFoodFat';
    private static $clientFoodAmountOfFat = 'FoodView::clientFoodAmountOfFat';
    private static $send = 'FoodView::send';

    private function clientFormHTML() {
        return 
            '<form href="?" method="POST">
                <p>' . $this->message . '</p>

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
                <input type="submit" id="' . self::$send . '" name="' . self::$send . '" value="Save"/>
    
            </form>
            ';
      }
}
