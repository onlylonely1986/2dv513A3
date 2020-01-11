<?php

namespace model;

class ClientStorage {

    private static $serverName;
    private static $userName;
    private static $passWord;
    private static $dbName;
    private static $dbTableClients;
    private static $dbTableExercises;
    private static $conn;
    private static $user;
    
    public function __construct($settings) 
    {
        self::$serverName = $settings->dbserverName;
        self::$userName = $settings->dbuserName;
        self::$passWord = $settings->dbpassWord;
        self::$dbName = $settings->dbName;
        self::$dbTableClients = $settings->dbTableClients;
        self::$dbTableExercises = $settings->dbTableExercises;
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
        $query = "SELECT * FROM " . self::$dbTableClients;
        
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

    public function getExercisesFromDB() 
    {
        $data = array();
        $query = "SELECT * FROM " . self::$dbTableExercises;
        
        if ($result = self::$conn->query($query)) 
        {
            if(!$result) 
            {
                throw new ConnectionException();
                return false;
            }
            while($obj = $result->fetch_object()) {
                $exercises = new Exercise($obj->exercise, $obj->weight, $obj->repetitions, $obj->sets, $obj->rest);
                $exercises->setId($obj->id);
                array_push($data, $exercises);
            }
            
            $result->close();
            return $data;
            
        }
    }


    public function saveNewClientToDB(Client $client) : bool {
        $this->connect();
        $sql = "INSERT INTO " . self::$dbTableClients;
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

    public function saveNewExerciseToDB(Exercise $exercise, $id) : bool {
        $this->connect();
        $sql = "INSERT INTO " . self::$dbTableExercises;
        $sql .= "(";
        $sql .= "`exercise`, `weight`, `repetitions`, `sets`, `rest`, `clientid`";
        $sql .= ")";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'". $exercise->getExercise() ."', ";
        $sql .= "'". $exercise->getWeight() ."', "; 
        $sql .= "'". $exercise->getRepetitions() ."', "; 
        $sql .= "'". $exercise->getSets() ."', ";
        $sql .= "'". $exercise->getRest() ."', ";
        $sql .= "'". $id ."'";
        $sql .= ");";
        
        $results = self::$conn->query($sql);

        if(!$results) {
            throw new ConnectionException();
        }
        return true;

    }

    public function saveNewFoodToDB() {

    }

    public function getClientInfo($id) : Client {
        $query = "SELECT * FROM  " . self::$dbTableClients . " WHERE id = '" . $id . "'";
        
        if ($result = self::$conn->query($query)) 
        {
            $obj = $result->fetch_object();
            $client = new Client($obj->name, $obj->dateOfBirth, $obj->weight, $obj->goal);
            $client->setId($obj->id);
            return $client;
        }
            /*if(!$result) 
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
            return $data; */
    }

    public function getClientExercises($id) : Exercise {
        $query = "SELECT * FROM  " . self::$dbTableExercises . " WHERE clientid = '" . $id . "'";
        
        if ($result = self::$conn->query($query)) 
        {
            $obj = $result->fetch_object();
            $exercises = new Exercise($obj->exercise, $obj->weight, $obj->repetitions, $obj->sets, $obj->rest);
            $exercises->setId($obj->id);
            return $exercises;
        }
    }

    public function getClientFood($id) {
        
    }
}