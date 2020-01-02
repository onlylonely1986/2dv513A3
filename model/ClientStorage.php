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
    

    public function __construct($settings) {
        self::$serverName = $settings->dbserverName;
        self::$userName = $settings->dbuserName;
        self::$passWord = $settings->dbpassWord;
        self::$dbName = $settings->dbName;
        self::$dbTable = $settings->dbTableClients;
    }

    public function connect() {
        self::$conn = new \mysqli(
            self::$serverName,
            self::$userName, 
            self::$passWord, 
            self::$dbName
        );
        if (!self::$conn->connect_errno) {
            return true;
        } else {
            throw new ConnectionException();
            exit();
            return false;
        }
    }

    public function getClientFromDB(Client $client) {
        $this->connect();
        $query = "SELECT * FROM " . self::$dbTable;
        
        if ($result = self::$conn->query($query)) {
            if(!$result) {
                throw new ConnectionException();
                return false;
            }
            while ($row = $result->fetch_row()) {
                if ($row[0] == $newUser->getName() && $row[1] == password_verify($newUser->getPass(), $row[1])) {
                    return true;
                }
            }
            $result->close();
        }
        return false;
    }


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
