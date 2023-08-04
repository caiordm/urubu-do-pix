<?php

use App\Controller\UserController;

require_once './vendor/autoload.php';

$routes = [
    "/users" => [
        'controller' => 'App\Controller\UserController',
        'method' => 'listarUsuarios',
        'methods' => ['GET']
    ],
    "/createUser" => [
        'controller' => 'App\Controller\UserController',
        'method' => 'criarUsuario',
        'methods' => ['POST']
    ],
    "/deleteUser" => [
        'controller' => 'App\Controller\UserController',
        'method' => 'deletarUsuario',
        'methods' => ["DELETE"]
    ],
    "/updateUser" => [
        'controller' => 'App\Controller\UserController',
        'method' => 'atualizarUsuario',
        'methods' => ["PUT"]
    ],
    "/createOrder" => [
        'controller' => 'App\Controller\OrderController',
        'method' => 'createOrder',
        'methods' => ["POST"]
    ],
    "/addDeposit" => [
        'controller' => 'App\Controller\TransactionController',
        'method' => 'addDeposit',
        'methods' => ["POST"]
    ],
    "/getBalance" => [
        'controller' => 'App\Controller\TransactionController',
        'method' => 'getBalance',
        'methods' => ["GET"]
    ],
    "/withdraw" => [
        'controller' => 'App\Controller\TransactionController',
        'method' => 'withdraw',
        'methods' => ["DELETE"]
    ]
];

// Obtém a URL e Método da requisição atual.
$requestUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
// Remove os parâmetros da URL, caso existam.
$requestUrl = strtok($requestUrl, '?');

// Se existe a chave "requestUrl" no array routes
if (array_key_exists($requestUrl, $routes)) {
    $routeInfo = $routes[$requestUrl];
    /* ex: routeInfo = $routes[
        "/users" => [
            'controller' => 'App\...'
        ]
    ]
    ...
    */

    // Verifica se o método da requisição está permitido para a rota.
    if (isset($routeInfo['methods']) && !in_array($requestMethod, $routeInfo['methods'])) {
        header("HTTP/1.0 405 Method Not Allowed");
        header("Allow: " . implode(", ", $routeInfo['methods']));
        echo "405 Method Not Allowed";
        exit();
    }

    $controllerName = $routeInfo['controller'];
    $methodName = $routeInfo['method'];

    // Inclua o arquivo do controlador.
    include_once './app/Controller/'. $controllerName .'.php';

    // Crie uma instância do controlador e chame o método correspondente.
    $controller = new $controllerName;
    $controller->$methodName();

    // Adicione os cabeçalhos Access-Control na resposta.
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: " . implode(", ", $routeInfo['methods']));
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
} else {
    // Rota não encontrada. Retorne uma resposta de erro, por exemplo.
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
    exit();
}
