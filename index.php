<?php

/**
 * index.php
 * 
 * The entry point of the application
 * 
 * @author Lone Nilsson, Sanna Gustafsson
 * @version 1.0
 * @link https://github.com/onlylonely1986/2dv513A3
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once('settings.php');
require_once('Application.php');

session_start();

$settings = new settings();
$start= new Application($settings);
$start->run();
