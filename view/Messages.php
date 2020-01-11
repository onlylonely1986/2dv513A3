<?php

namespace view;

class Messages 
{
    public static $messageToUserConn = 'Something went wrong when trying to connect to database.';
    public static $saveNewClient = 'Saved a new client to DB.';
    public static $fillAll = 'Please fill all fields with data.';
    public static $wentGood = 'Saved new client successfully.';
    public static $wentGoodEx = 'Saved new exercise to client successfully.';
    public static $wentGoodFood = 'Saved new food advice to client successfully.';
    public static $wentBad = 'Something went wrong.';

    public static $toShortName = 'Username has too few characters, at least 3 characters.';
    public static $toShortPass = 'Password has too few characters, at least 6 characters.';
    public static $passNotMatch = 'Passwords do not match.';
    public static $invalidChars = 'Username contains invalid characters.';
    public static $invalidCharsInInput = 'You are not allowed to publish that kind of characters!';
    public static $userExists = 'User exists, pick another username.';
    public static $messagePublished = 'Your scribble has been printed';
}