<?php

namespace model;

class ClientStorage {

    private static $serverName;
    private static $userName;
    private static $passWord;
    private static $dbName;
    private static $dbTable;
    private static $conn;
    private static $user;
    
    public function __construct($settings) 
    {
        self::$serverName = $settings->dbserverName;
        self::$userName = $settings->dbuserName;
        self::$passWord = $settings->dbpassWord;
        self::$dbName = $settings->dbName;
        self::$dbTable = $settings->dbTableClients;
    }

    public function connect() 
    {
        self::$conn = new \mysqli(
            self::$serverName,
            self::$userName, 
            self::$passWord, 
            self::$dbName
        );

        if (!self::$conn->connect_errno) 
        {
            echo "connect med db funkade bra";
            return true;
        } else {
            throw new ConnectionException();
            exit();
            return false;
        }
    }
    public function getClientsFromDB() 
    {
        //  
        $data = array();
        $query = "SELECT * FROM " . self::$dbTable;
        
        if ($result = self::$conn->query($query)) 
        {
            if(!$result) 
            {
                throw new ConnectionException();
                return false;
            }
            while($obj = $result->fetch_object()) {
                $item = new Client($obj->name, $obj->dateOfBirth, $obj->weight, $obj->goal);
                array_push($data, $item);
            }
            
            
            $result->close();
            // var_dump($data);
            return $data;
            
        }
        // return $data;
    }
    // min kod för att hämta scribbles i L3
    // public function getSavedScribbles() : array {
    //     $sqli = "SELECT * FROM " . self::$dbTable;
    //     $result = mysqli_query(self::$conn, $sqli);
    //     if(!$result) {
    //         throw new ConnectionException();
    //     }
    //     $data = array();
    //     if(mysqli_num_rows($result) > 0) {
    //         while($obj = $result->fetch_object()) {
    //             $this->collectionOfItems[] = new ScribbleItem($obj->user, $obj->title, $obj->text);
    //         }
    //     }
    //     mysqli_close(self::$conn);
    //     return $this->collectionOfItems;
        
    // }
    public function saveNewClientToDB(Client $client) {
        $this->connect();
        $inputPwd = $user->getPass();
        $hashPwd = password_hash($inputPwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO " . self::$dbTable;
        $sql .= "(";
        $sql .= "`username`, `password`";
        $sql .= ")";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'". $user->getName() ."', ";
        $sql .= "'". $hashPwd ."'";
        $sql .= ");";
        $results = self::$conn->query($sql);       
        if(!$results) {
            throw new ConnectionException();
        }
    }
}