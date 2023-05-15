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
  
    $user = new UsuarioController();
    $result = $user->setUsuario($name, $email, $tel);


    if($result){
        Flight::json([
            'status' =>'sucess',
            'msg' => 'Usuario cadastrado',
            'data' => $result
        ]);
    } else{
        Flight::json([
            'status' =>'error',
            'msg' => '',
            'data' => $result
        ]);
    }
});

Flight::start();
