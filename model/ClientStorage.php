<?php

namespace model;

class ClientStorage {

    private static $serverName;
    private static $userName;
    private static $passWord;
    private static $dbName;
    private static $dbTableClients;
    private static $dbTableExercises;
    private static $dbTableFood;
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
        self::$dbTableFood = $settings->dbTableFood;
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

    public function searchByName($searchWord)
    {
        $data = array();
        $query = "SELECT * FROM " . self::$dbTableClients;
        $query .= " WHERE name LIKE '". $searchWord ."%'";
        $query .= " GROUP BY name";
        
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

    public function getClientInfo($id) : Client {
        $query = "SELECT * FROM  " . self::$dbTableClients . " WHERE id = '" . $id . "'";
        
        if ($result = self::$conn->query($query)) 
        {
            $obj = $result->fetch_object();
            $client = new Client($obj->name, $obj->dateOfBirth, $obj->weight, $obj->goal);
            $client->setId($obj->id);
            return $client;
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
                $exercises->setId($obj->clientid);
                array_push($data, $exercises);
            }
            
            $result->close();
            return $data;
            
        }
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

    public function getClientExercises($id){
        $query = "SELECT * FROM  " . self::$dbTableExercises . " WHERE clientid = '" . $id . "'";
        
        if ($result = self::$conn->query($query)) 
        {
            $obj = $result->fetch_object();
            if ($obj)
            {
                $exercises = new Exercise($obj->exercise, $obj->weight, $obj->repetitions, $obj->sets, $obj->rest);
                $exercises->setId($obj->clientid);
                return $exercises;
            }
        }
    }

    public function getFoodFromDB()
    {
        $data = array();
        $query = "SELECT * FROM " . self::$dbTableFood;
        
        if ($result = self::$conn->query($query)) 
        {
            if(!$result) 
            {
                throw new ConnectionException();
                return false;
            }
            while($obj = $result->fetch_object()) {
                $food = new Food($obj->protein, $obj->amountprotein, $obj->carbs, $obj->amountcarbs, $obj->fat, $obj->amountfat);
                $food->setId($obj->clientid);
                array_push($data, $food);
            }
            
            $result->close();
            return $data;
            
        }
    }

    public function saveFoodToDB(Food $food, $id) : bool {
        $this->connect();        
        $sql = "INSERT INTO " . self::$dbTableFood;
        $sql .= " (";
        $sql .= "`protein`, `amountprotein`, `carbs`, `amountcarbs`, `fat`, `amountfat`, `clientid`";
        $sql .= ")";
        $sql .= " VALUES ";
        $sql .= "(";
        $sql .= "'". $food->getProtein() ."', ";
        $sql .= "'". $food->getAmountProtein() ."', "; 
        $sql .= "'". $food->getCarbs() ."', "; 
        $sql .= "'". $food->getAmountCarbs() ."', ";
        $sql .= "'". $food->getFat() ."', ";
        $sql .= "'". $food->getAmountFat() ."', ";
        $sql .= "'". $id ."'";
        $sql .= ");";

        $results = self::$conn->query($sql);

        if(!$results) {
            throw new ConnectionException();
        }
        return true;
    }

    public function getClientFood($id) 
    {
        $query = "SELECT * FROM  " . self::$dbTableFood . " WHERE clientid = '" . $id . "'";
        
        if ($result = self::$conn->query($query)) 
        {
            $obj = $result->fetch_object();
            if ($obj)
            {
                $food = new Food($obj->protein, $obj->amountprotein, $obj->carbs, $obj->amountcarbs, $obj->fat, $obj->amountfat);
                $food->setID($obj->clientid);
                return $food;
            }
        }
    }

    public function getRowsByView()
    {
        $data = array();
        // denna funkade att köra direkt ifrån DB istället och då funkade select under
        // under förutsättning att du har några som har övningen pushups :)
        /*$query = "CREATE VIEW view_newTable AS SELECT";
        $query .= " client.name, client.goal, exercises.exercise FROM";
        $query .= " client, exercises WHERE client.id = exercises.clientid";*/
        $query = "SELECT * FROM `view_newTable` WHERE exercise='pushups';";
        
        if ($result = self::$conn->query($query)) 
        {
            if(!$result) 
            {
                throw new ConnectionException();
                return false;
            }
            
            while($obj = $result->fetch_object()) {
                array_push($data, $obj);
            }
            
            $result->close();
            return $data;
        }
        return $data;
    }
}