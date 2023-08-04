<?php

namespace App\Model;
use App\Model\Database;

class Transaction {
    private $id;
    private $type;
    private $value;
    private $userId;

    public function getId(){
        return $this->id;
    }

    public function getType(){
        return $this->type;
    }

    public function getValue(){
        return $this->value;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    /**
     * Método que adiciona dinheiro pra o usuário
     * @param int userId
     * @param double value
     * @return boolean
     */
    public static function addDeposit($userId, $value){
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "INSERT INTO transaction(type, user_id, value) VALUES('deposit', :user_id, :value);";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':value', $value);
            $stmt->execute();

            return true;

        } catch (\PDOException $e) {
            echo "Falha ao depositar: " . $e->getMessage();
            return false;
        }
    }


    /**
     * Método que traz o saldo total do usuário
     * @param int userId
     * @return assoc_array
     */
    public static function getBalance($userId){
        $db = new Database();
        $conn = $db->getConnection();
    
        try {
            $sql = "SELECT * FROM transaction WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $balance = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            return $balance;
    
        } catch (\PDOException $e) {
            echo "Falha ao depositar: " . $e->getMessage();
            return false;
        }
        
    }

    /**
     * Método que realiza a ação de saque
     * @param int transactionId
     * @return boolean
     */
    public static function withdraw($transactionId){
        $db = new Database();
        $conn = $db->getConnection();
    
        try {
            $sql = "DELETE FROM transaction WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $transactionId);
            $stmt->execute();
    
            return true;
    
        } catch (\PDOException $e) {
            echo "Falha ao depositar: " . $e->getMessage();
            return false;
        }
        
    }
}

?>