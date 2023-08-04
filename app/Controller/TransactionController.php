<?php

namespace App\Controller;
use App\Model\Transaction;

class TransactionController {
    public function addDeposit(){
        $request = json_decode(file_get_contents("php://input"), true);
        $requestValue = $request['value'];
        $requestUserId = $request['userId'];

        $transaction = Transaction::addDeposit($requestUserId, $requestValue);

        header("Content-Type: application/json");
        if($transaction){
            echo "Depositado com sucesso";
        } else{
            echo "Houve algum erro na realização do depósito";
        }
    }

    public function getBalance(){
        $request = json_decode(file_get_contents("php://input"), true);
        $requestUserId = $request['userId'];

        $transaction = Transaction::getBalance($requestUserId);
        $totalBalance = 0;
        $simpleBalance = 0;
        $onlyProfit = 0;

        foreach($transaction as $deposit){
            $totalBalance+=$deposit['value'];

            // Calcula o lucro e depois soma com o saldo total

            $profit = $deposit['value'] * 0.333;
            $totalBalance+=$profit;

            $simpleBalance+=$deposit['value']; // Saldo sem lucros
            $onlyProfit+=$profit; // Somente o valor do lucro
        }

        $response = [
            'BalanceWithProfit' => $totalBalance, 4,
            'InitalBalance' => $simpleBalance,
            'OnlyProfit' => $onlyProfit
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function withdraw(){
        $request = json_decode(file_get_contents("php://input"), true);
        $requestTransactionId = $request['transactionId'];

        $transaction = Transaction::withdraw($requestTransactionId);

        header('Content-Type: application/json');
        if($transaction){
            echo "Saque realizado com sucesso :)";
        } else {
            echo "Não conseguimos sacar, tente novamente em alguns segundos :(";
        }
    }
}

?>