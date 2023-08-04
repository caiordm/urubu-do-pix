<?php

namespace App\Model;

use App\Model\Database;

class User
{
    private $id;
    private $name;

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Método para buscar todos os usuários
     * @return object
     */
    public static function getAll()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM user;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $userObject = [];
        foreach ($users as $userData) {
            $user = new User();
            $user->id = $userData['id'];
            $user->name = $userData['name'];
            $userObject[] = $user;
        }

        return $userObject;
    }

    public static function create($name)
    {
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "INSERT INTO user(name) VALUES(:name);";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            return $name;
        } catch (\PDOException $e) {
            die("Falha: " . $e->getMessage());
        }
    }

    public static function delete($id)
    {
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "DELETE FROM user WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $id;
        } catch (\PDOException $e) {
            die("Falha:" . $e->getMessage());
        }
    }
    
    public static function update($id ,$name){
        $db = new Database();
        $conn = $db->getConnection();
    
        try {
            $sql = "UPDATE user SET name = :name, updated_at = NOW() WHERE id = :id;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
    
            return $id;
        } catch (\PDOException $e) {
            die("Falha:" . $e->getMessage());
        }

    }
}
