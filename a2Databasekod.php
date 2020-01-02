<?php
 
    $dbConn = new \mysqli(
        'localhost', 
        'user1', 
        'SU4toRmJ0PAlEhI2', 
        'a2Task3'
        );

    if (!$dbConn->connect_errno) {
        echo '<h2>Db is connected!</h2><br>';
        
    } else {
        throw new ConnectionException();
        exit();
    }

echo '<br>';


function WriteToArr() {
    while (($line = fgets($file)) !== false  && count($arr) < 9000) {
        $obj = json_decode($line);
        array_push($arr, $obj); // 2 st
        
        $lastItem = end($arr);
        // foreach($arr as $key) {
       
        $id = "$lastItem->id";
        $parent_id = "$lastItem->parent_id";
        $link_id = "$lastItem->link_id";
        $name = "$lastItem->name";
        $author = "$lastItem->author";
        $body = "$lastItem->body";
        $subreddit_id = "$lastItem->subreddit_id";
        $subreddit = "$lastItem->subreddit";
        $score = "$lastItem->score";
        $created_utc = "$lastItem->created_utc";                  
        // }

        if ($stmt->execute() === TRUE) {
            // echo "New record created successfully";
        } else {
                echo "Error: <br>" . $dbConn->error;
        }
    }           
} 

$arr = [];

$time_start = microtime(true);
// prepare and bind
$stmt = $dbConn->prepare("INSERT INTO comments (body, comment_name, created_utc, id, link_id, parent_id, score, username) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisssis", $body, $comment_name, $created_utc, $id, $link_id, $parent_id, $score, $username);


$stmt2 = $dbConn->prepare("INSERT INTO subreddit (name1, subreddit_id) 
              VALUES (?, ?)");
$stmt2->bind_param("ss", $name_sub, $subreddit_id);


$stmt3 = $dbConn->prepare("INSERT INTO user (name1, comment_id) 
              VALUES (?, ?)");
$stmt3->bind_param("ss", $username, $id);
// $stmt = $dbConn->prepare("INSERT INTO tableTest4 (id, parent_id, link_id, name1, author, body, subreddit_id, subreddit, score, created_utc) 
//              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
// $stmt->bind_param("ssssssssii", $id, $parent_id, $link_id, $name, $author, $body, $subreddit_id, $subreddit, $score, $created_utc);

$file = fopen("RC_2011-07", "r"); // TODO obs bortkommenterat för att inte råka ladda in allt igen

if ($file) {
    
    //Output lines until EOF is reached
    while(! feof($file)) {
        $linecount = 0;
        if ($linecount < 9000) {
            while (($line = fgets($file)) !== false) {
               $linecount++;
               $lastItem = json_decode($line);
            // array_push($arr, $obj);

        
        // if (count($arr) < 9000) {
            // $lastItem = end($arr);
            // foreach($arr as $key) {
            // $body
            $body = "$lastItem->body";
            $comment_name = "$lastItem->name";
            $created_utc = "$lastItem->created_utc";   
            $id = "$lastItem->id";
            $link_id = "$lastItem->link_id";
            $parent_id = "$lastItem->parent_id";
            $score = "$lastItem->score";
            $username = "$lastItem->author";
            
            $name_sub = "$lastItem->subreddit";
            $subreddit_id = "$lastItem->subreddit_id";               
            // }
    
                if ($stmt->execute() === TRUE && $stmt2->execute() === TRUE && $stmt3->execute() === TRUE) {
                // echo "New record created successfully";
                } else {
                    echo "Error: <br>" . $dbConn->error;
                }
            }
            $arr = [];
        }
    
    // WriteToArr();
    }
    fclose($file);
} else {
    // error opening the file.
}



$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Completed in ". $time ." seconds <hr>";

$dbConn->close();
