<?php

class DB{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'erpproj';

    public function connect() {
        $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}