<?php
/*
**
*@author: Jefrey Aristizabal
*@date: 20/06/2025
*@description: ORM (Object Relational Mapping)
*
*/

class Database{
    private $db_connection;
    private $username;
    private $password;
    private $db;
    private $host;
    private $port;

    public function __construct($username, $password, $db, $host, $port = 3306)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->host = $host;
        $this->port = $port;
    }

    public function openConnection(){
        $this->db_connection = mysqli_connect($this->host, $this->username, $this->password, $this->db, $this->port)
        or die("ERROR: Couldn't connect to the database");

        return $this->db_connection;
    }

    public function closeConnection(){
        mysqli_close($this->db_connection);
    }
}