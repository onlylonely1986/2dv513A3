<?php

/**
 * Application.php
 * 
 * The entry point of the application
 * 
 * @author Lone Nilsson, Sanna Gustavsson
 * @version 1.0
 * @link https://github.com/onlylonely1986/2dv513A3
 */

// require_once("model/UserStorage.php");
// require_once("model/ScribbleStorage.php");
// require_once("model/SessionModel.php");
// require_once("controller/LoginController.php");
// require_once("controller/RegisterController.php");
// require_once("controller/ScribbleController.php");
// require_once("view/ExceptionHTMLMessages.php");
require_once("view/LayoutView.php");
// require_once("view/LoginView.php");
// require_once("view/RegisterView.php");
// require_once("view/DateTimeView.php");
// require_once("view/ScribbleView.php");

class Application {
    private $layoutView;

    public function __construct($settings) {
        $this->layoutView  = new \view\LayoutView();
    }

    public function run() {
        $this->layoutView->render();
    }
}