<?php

namespace App\Controller;
use App\Model\Order;

class OrderController {
    public function createOrder(){
        $request = json_decode(file_get_contents("php://input"), true);
        $requestValue = $request['value'];
        $requestUserId = $request['userId'];

        $order = Order::create($requestValue, $requestUserId);

        header("Content-Type: application/json");
        echo "Criado: " . $order;
    }
}

?>