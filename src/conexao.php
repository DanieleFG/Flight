<?php
namespace Daniele\Dashboard;

class conexao {
    
    private $conn;

    public function __construct()
    {
         $host = "127.0.0.1";
         $usuario = "root";
         $senha = "123456";
         $banco = "my_database";
         $fetchTableName = 'data';
         $port = '3307';
        //  $conn;
        $this->conn = new \mysqli($host, $usuario, $senha, $banco, $port);
        if ($this->conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $this->conn->connect_error);
        }
    }

    public function getConn()
    {
        return $this->conn;
    }
}
// $conn = new conexao();
// $mysqli = $conn->getConn();
// print_r($mysqli);