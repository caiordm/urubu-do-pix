<?php 

namespace App\Controller;
use App\Model\User;

class UserController{
    public function listarUsuarios(){
        $users = User::getAll();

        // Eu estava recebendo os dados como um objeto private, então converti em um array associativo para depois converter em json;
        $userArray = [];
        foreach($users as $user){
            $userArray[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
            ];
        }

        $userJson = json_encode($userArray);

        header('Content-Type: application/json');
        echo $userJson;
    }   

    public function criarUsuario(){
        $request = json_decode(file_get_contents('php://input'), true);
        $requestName = $request['name'];

        $user = User::create($requestName);

        header('Content-Type: application/json');
        echo "Criado:" . $user;
    }

    public function deletarUsuario(){
        $request = json_decode(file_get_contents("php://input"), true);
        $requestId = $request['id'];

        $user = User::delete($requestId);

        header('Content-Type: application/json');
        echo "Deletado:" . $user;
    }
    
    public function atualizarUsuario(){
        $request = json_decode(file_get_contents("php://input"), true);
        $requestId = $request['id'];
        $requestName = $request['name'];

        $user = User::update($requestId, $requestName);

        header('Content-Type: application/json');
        echo "Atualizado:" . $user;
    }


}

?>