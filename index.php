<?php

require_once __DIR__. '/vendor/autoload.php';
use Daniele\Dashboard\Controller\UsuarioController;


Flight::route('GET /', function () {
    $user = new UsuarioController();
    $result = $user->getUsuario();

    if(!empty($result)){
        Flight::json([
            'status'=> 'ok',           
            'data' => $result
        ]);
        return;
    }else{
        Flight::json([
            'status'=> 'error',
            'msg' => 'Inner server not found',
            'data' => []
        ], 417);
        return;
    }
});

Flight::route('POST /add', function(){
    $name = Flight::request()->data['name'];    
    $email = Flight::request()->data['email'];
    $tel = Flight::request()->data['tel'];
    $result = false;
    $user = new UsuarioController();
    $msg =$user->validarDados($name, $email, $tel);
    if($msg == "Dados Validos"){
        $result = $user->setUsuario($name, $email, $tel);
    } 

    if($result){
        Flight::json([
            'status' =>'sucess',
            'msg' => 'Usuario cadastrado',
            'data' => $result
        ]);
    } else{
        Flight::json([
            'status' =>'error',
            'msg' => $msg,
            'data' => $result
        ]);
    }
});

Flight::route('PUT /update/@id', function($id) {
    $user = new UsuarioController();
    $result = $user->getUsuarioId($id);
    
 
    $result_update = false;
    if($result){
        $name = Flight::request()->data['name']; 
        $email = Flight::request()->data['email'];
        $tel = Flight::request()->data['tel'];

        $msg = $user->validarDados($name, $email, $tel);

        if($msg == "Dados Validos"){
            $result_update = $user->updateUsuario($id, $name, $email, $tel);
            $result_ = $user->getUsuarioId($id);
        }
    }else{
        $msg = 'Usuario não consta na nossa base de dados.';
    }

    if ($result_update) {
        Flight::json([
            'status' => 'success',
            'msg' => $result_update,
            'data' => $result_
        ]);
    } else {
        Flight::json([
            'status' => 'error',
            'msg' => $msg,
            'data' => $result_update
        ]);
    }
});

Flight::route('DELETE /del/@id', function($id){
    $user = new UsuarioController();
    $result = $user->deleteUsuario($id);

    if($result){
        Flight::json([
            'status' =>'sucess',
            'msg' => $result,
            'data' => ''
        ]);
    } else{
        Flight::json([
            'status' =>'error',
            'msg' => $result,
            'data' => ''
        ]);
    }
});

Flight::start();
