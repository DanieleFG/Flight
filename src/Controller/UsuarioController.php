<?php
namespace Daniele\Dashboard\Controller;

require_once 'vendor/autoload.php';

use Daniele\Dashboard\conexao;
use mysqli;

class UsuarioController {
    private $conn;

    public function __construct()
    {       
        $this->conn = new conexao();
    }

    public function getUsuario()
    {
        $sql = "SELECT * FROM user";

        $rs = $this->conn->getConn()->query($sql);
        while($row =$rs->fetch_assoc()){
            $results[] = $row;
        }
        return $results;
    }

    public function setUsuario($name, $email, $tel)
    {
        $name = $this->conn->getConn()->real_escape_string($name);
        $email = $this->conn->getConn()->real_escape_string($email);
        $tel = $this->conn->getConn()->real_escape_string($tel);
        
        $sql = "INSERT INTO `user`(`name`, `email`, `tel`) 
                VALUE ('$name', '$email', '$tel')";
         $this->conn->getConn()->query($sql);
        $id = mysqli_insert_id($this->conn->getConn());

        $sql_selec = "SELECT * FROM user WHERE  id= ".$id;
        $rs= $this->conn->getConn()->query($sql_selec);
        while($row = mysqli_fetch_assoc($rs)){
            $result = $row;
        }
        return  $result;


    }    
    
    function validarDados($name, $email, $tel){
        $msg = "";
        if(strlen($name) > 7 && strlen($email)> 10 && strlen($tel) > 11){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "Dados Validos";
               return $msg;
            }else{
                $msg .= "Email Invalido";
            }
        }else{
            $msg .= "Quantidade baixa e caracter";
        }
        return $msg;
    }

    function getUsuarioId($id){
        $sql = "SELECT * FROM user WHERE id=".$id;
        $result = [];
        $rs = $this->conn->getConn()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            $result[] = $row;
        }
        return $result;
    }

    function updateUsuario($id, $name, $email, $tel){
        $sql = "UPDATE user SET name='". $name."', email='". $email ."', tel='".$tel."' WHERE id=".$id;
     
        $msg= '';
        $rs =  $this->conn->getConn()->query($sql);   
        if($rs){
            return $msg = "Update success";
        } else{
            return  $msg = "Error";
        }   
    }

    function deleteUsuario($id){
        $sql = "DELETE FROM user WHERE id=".$id;
        $rs = $this->conn->getConn()->query($sql);
        if($rs){
            return $msg = "Delete success";
        } else{
            return  $msg = "Error";
        }   
    }
}
// $user = new UsuarioController();
// $result = $user->getUsuario();
// // $user->setUsuario("José da Silva", "jose@example.com", "(99) 9 6000-6000");
// var_dump($result);