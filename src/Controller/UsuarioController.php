<?php
namespace Daniele\Dashboard\Controller;

require_once 'vendor/autoload.php';

use Daniele\Dashboard\conexao;

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
        
    }
}
// $user = new UsuarioController();
// $result = $user->getUsuario();
// // $user->setUsuario("José da Silva", "jose@example.com", "(99) 9 6000-6000");
// var_dump($result);