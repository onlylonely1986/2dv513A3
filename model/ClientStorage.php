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
                $client = new Client($obj->name, $obj->dateOfBirth, $obj->weight, $obj->goal);
                $client->setId($obj->id);
                array_push($data, $client);
            }
            
            
            $result->close();
            return $data;
            
        }
    }

    public function saveNewClientToDB(Client $client) : bool {
        $this->connect();
        $sql = "INSERT INTO " . self::$dbTable;
        $sql .= "(";
        $sql .= "`name`, `dateOfBirth`, `weight`, `goal`";
        $sql .= ")";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'". $client->getName() ."', ";
        $sql .= "'". $client->getBirth() ."', "; 
        $sql .= "'". $client->getWeight() ."', "; 
        $sql .= "'". $client->getGoal()   ."'";; 
        $sql .= ");";
        
        $results = self::$conn->query($sql);
        if(!$results) {
            throw new ConnectionException();
        }
        return true;
    }

    public function saveNewExerciseToDB() {

    }

    public function saveNewFoodToDB() {

    }

    public function getClientInfo($id) {

    }

    public function getClientExercises($id) {
        
    }

    public function getClientFood($id) {
        
    }
}