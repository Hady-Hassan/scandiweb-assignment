<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password= $password;
        $this->database = $database;
    }

    public function connect()
    {
        $this->connection = new mysqli(
            $this->host, 
            $this->username, 
            $this->password, 
            $this->database);
    }

    public function disconnect()
    {
        $this->connection->close();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query($query)
    {
        return $this->connection->query($query);
    }

    
}
?>