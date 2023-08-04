<?php

namespace App\Model;

class Database
{

    private $host = 'localhost';
    private $dbname = 'urubu-do-pix';
    private $username = 'root';
    private $password = 'rootpass';
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new \PDO('mysql:' . 'host=' . $this->host . ';dbname=' . $this->dbname . '', $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Falha na conexão: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
