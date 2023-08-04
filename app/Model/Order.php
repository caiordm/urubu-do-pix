<?php

namespace App\Model;
use App\Model\Database;

class Order {
    private $id;
    private $value;
    private $userId;


    public function getId(){
        return $this->id;
    }

    public function getValue(){
        return $this->value;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public static function create($value, $userId){
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "INSERT INTO orders (value, user_id) VALUES (:value, :userId);";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            return "$value, $userId";

        } catch (\PDOException $e) {
            echo "Falha: " . $e->getMessage();
        }
    }
}

?>